<?php

namespace app\modules\reporting\controllers;

use app\models\CASE_TYPE_MODEL;
use app\models\DISCIPLINARY_TYPE_MODEL;
use app\models\STUDENT_INCIDENCE;
use app\modules\reporting\models\UPLOAD_MODEL;
use app\modules\tracking\models\FILEUPLOAD;
use Yii;
use app\modules\reporting\models\INCIDENCE_MODEL;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportController implements the CRUD actions for INCIDENCE_MODEL model.
 */
class ReportController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all INCIDENCE_MODEL models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => INCIDENCE_MODEL::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReportCase()
    {
        $session = Yii::$app->session;

        $model = new STUDENT_INCIDENCE();

        if (Yii::$app->request->isPost) {
            //store the values in a sessions
            $post = Yii::$app->request->post('STUDENT_INCIDENCE');
            $session['DISCIPLINARY_TYPE_ID'] = $post['DISCIPLINARY_TYPE_ID'];
            $session['CASE_TYPE_ID'] = $post['CASE_TYPE_ID'];
            //redirect to the create table now
            return $this->redirect(['first-case']);
        }
        return $this->render('new-case', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single INCIDENCE_MODEL model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new INCIDENCE_MODEL model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionFirstCase()
    {

        //get the case type session
        $connection = \Yii::$app->db; //for use in transactions
        $session = Yii::$app->session;

        $case_type_id = $session->get('CASE_TYPE_ID');
        $discp_type_id = $session->get('DISCIPLINARY_TYPE_ID');

        $model = new INCIDENCE_MODEL();
        $student_case = new STUDENT_INCIDENCE();
        $uploads = new FILEUPLOAD();
        $student_case->CASE_TYPE_ID = $case_type_id;
        $student_case->DISCIPLINARY_TYPE_ID = $discp_type_id;
        if (Yii::$app->request->isPost) {
            $transaction = $connection->beginTransaction();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //save the first model
                $student_case->INCIDENCE_ID = $model->INCIDENCE_ID; //get the saved id
                if ($student_case->load(Yii::$app->request->post()) && $student_case->save()) {
                    //now save the second and final one
                    $transaction->commit(); //commit the transactions

                    //now redirect to file upload interface
                    $session['DISCIPLINARY_TYPE_ID'] = $model->INCIDENCE_ID;
                    return $this->redirect(['file-upload', 'incidence_id' => $model->INCIDENCE_ID]);
                } else {
                    $transaction->rollback(); //rollback the transaction
                }
            } else {
                $transaction->rollback(); //rollback the transaction
            }
        }
        return $this->render('create', [
            'model' => $model,
            'uploads' => $uploads,
            'student_case' => $student_case
        ]);

    }

    public function actionAppealCase($reg_no)
    {
    }

    public function actionFileUpload()
    {
        $session = Yii::$app->session;

        $incidence_id = $session->get('INCIDENCE_ID');
        //lets check if user has file to upload
        $model = new UPLOAD_MODEL();

        $dataProvider = new ActiveDataProvider([
            'query' => UPLOAD_MODEL::find()
                ->where(['INCIDENCE_ID' => $incidence_id])
                ->andWhere(['FILE_DELETED' => 1]),
        ]);

        return $this->render('/uploads/create', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Updates an existing INCIDENCE_MODEL model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $student_case = new STUDENT_INCIDENCE();
        $uploads = new FILEUPLOAD();

        if (Yii::$app->request->isPost) {
            var_dump($_POST);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->INCIDENCE_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'uploads' => $uploads,
                'student_case' => $student_case
            ]);
        }
    }

    public function actionCaseTypes()
    {
        $out = [];
        if (Yii::$app->request->isPost) {
            $parents = Yii::$app->request->post('depdrop_parents');
            if ($parents != null) {
                $disc_id = $parents[0];
                $out = CASE_TYPE_MODEL::GetCaseTypesList($disc_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
            }
        }

        return Json::encode(['output' => $out, 'selected' => '']);
    }

    /**
     * Deletes an existing INCIDENCE_MODEL model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the INCIDENCE_MODEL model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return INCIDENCE_MODEL the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = INCIDENCE_MODEL::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

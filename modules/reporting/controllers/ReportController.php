<?php

namespace app\modules\reporting\controllers;

use app\models\STUDENT_INCIDENCE;
use app\modules\tracking\models\FILEUPLOAD;
use Yii;
use app\modules\reporting\models\INCIDENCE_MODEL;
use yii\data\ActiveDataProvider;
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
    public function actionCreate()
    {
        $model = new INCIDENCE_MODEL();
        $student_case = new STUDENT_INCIDENCE();
        $uploads = new FILEUPLOAD();

        if (Yii::$app->request->isPost) {
            var_dump($_POST);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->INCIDENCE_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'uploads' => $uploads,
                'student_case' => $student_case
            ]);
        }
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
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);
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

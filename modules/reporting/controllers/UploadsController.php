<?php

namespace app\modules\reporting\controllers;

use app\modules\reporting\models\UPLOAD_MODEL;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UploadsController implements the CRUD actions for UserUploads model.
 */
class UploadsController extends Controller
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
     * Lists all UserUploads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $incidence_id = $session->get('INCIDENCE_ID');

        $dataProvider = new ActiveDataProvider([
            'query' => UPLOAD_MODEL::find()
                ->where(['INCIDENCE_ID' => $incidence_id])
                ->andWhere(['FILE_DELETED' => 0]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFileUpload()
    {
        $output = ['error' => 'Upload failed, please try again.']; //empty if successful
        $incidence_id = (Yii::$app->request->post('INCIDENCE_ID'));

        $model = new UPLOAD_MODEL();
        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'FILE_SELECTOR');
            $model->upload($incidence_id);
            if ($model->save()) {
                $output = [];
            }
        } else {
            $output = ['error' => 'No files were processed.'];
        }
        // return a json encoded response for plugin to process successfully
        return json_encode($output);
    }


    /**
     * Updates an existing UserUploads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->FILE_UPLOAD_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserUploads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /* @var $model \app\modules\reporting\models\UPLOAD_MODEL */
        $model = $this->findModel($id);
        $model->FILE_DELETED = 1;
        $model->save();

        return $this->redirect(['//report/report/file-upload']);
    }

    /**
     * Finds the UserUploads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UploadsModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UPLOAD_MODEL::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

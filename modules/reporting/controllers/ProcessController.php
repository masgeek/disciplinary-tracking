<?php

namespace app\modules\reporting\controllers;

use kotchuprik\sortable\actions\Sorting;
use Yii;
use app\modules\reporting\models\PROCESS_MODEL;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProcessController implements the CRUD actions for PROCESS_MODEL model.
 */
class ProcessController extends Controller
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
                    'sorting' => ['POST'],
                ],
            ],
        ];
    }
    /*
        public function actions()
        {
            $t =  [
                'sorting' => [
                    'class' => Sorting::className(),
                    'query' => PROCESS_MODEL::find(),
            ],
        ];

            var_dump($t);
    }
    */
    /**
     * Lists all PROCESS_MODEL models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PROCESS_MODEL::find()
                ->orderBy(['ORDER_NO' => SORT_ASC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionSorting()
    {
        $resp = [];
        //update the table based on the sorting
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post('sorting');
            //pass the array to the model for saving
            //$resp = $model->SaveSortedItems($post);
            foreach ($post as $order => $item_id) {
                $newOrder = (int)$order + 1;

                $model = PROCESS_MODEL::findOne($item_id);
                $model->ORDER_NO = $newOrder;
                $model->save();
            }

        }

        return json_encode($resp);
    }

    /**
     * Displays a single PROCESS_MODEL model.
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
     * Creates a new PROCESS_MODEL model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PROCESS_MODEL();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PROCESS_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PROCESS_MODEL model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PROCESS_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PROCESS_MODEL model.
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
     * Finds the PROCESS_MODEL model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PROCESS_MODEL the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PROCESS_MODEL::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

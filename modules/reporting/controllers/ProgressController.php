<?php

namespace app\modules\reporting\controllers;

use app\modules\reporting\models\PROCESS_MODEL;
use app\modules\reporting\models\TRACKING_MODEL;
use yii\filters\VerbFilter;

class ProgressController extends \yii\web\Controller
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
                    'first-office' => ['POST'],
                ],
            ],
        ];
    }

    public function actionActorAction()
    {
        return $this->render('actor-action');
    }

    public function actionFirstOffice()
    {
        $tracking = new TRACKING_MODEL();
        $process_actor = new PROCESS_MODEL();
        $incidence_id = \Yii::$app->request->post('INCIDENCE_ID');

        //return print_r($_POST);

        return $this->render('first-office', [
            'tracking' => $tracking,
            'process_actor' => $process_actor,
            'incidence_id' => $incidence_id
        ]);
    }

}

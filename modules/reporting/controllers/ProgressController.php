<?php

namespace app\modules\reporting\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\models\STUDENT_INCIDENCE;
use app\modules\reporting\models\PROCESS_ACTOR_MODEL;
use app\modules\reporting\models\TRACKING_MODEL;


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
        $process_actor = new PROCESS_ACTOR_MODEL();
        $incidence_id = \Yii::$app->request->post('INCIDENCE_ID');
        $incidence = STUDENT_INCIDENCE::findOne(['INCIDENCE_ID' => $incidence_id]);

        if ($tracking->load(Yii::$app->request->post())) {
            var_dump($tracking);
            die;
        }

        return $this->render('first-office', [
            'tracking' => $tracking,
            'process_actor' => $process_actor,
            'incidence' => $incidence
        ]);
    }

}

<?php

namespace app\modules\reporting\controllers;

use app\modules\reporting\models\TRACKING_DATE_MODEL;
use app\modules\setup\models\PROCESS_MODEL;
use Yii;
use yii\db\Expression;
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

    /**
     * @param $incidence_id
     * @return string
     */
    public function actionActorAction($incidence_id)
    {
        return $this->render('actor-action');
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionFirstOffice()
    {
        $tracking = new TRACKING_MODEL();

        $process_actor = new PROCESS_ACTOR_MODEL();

        $incidence_id = \Yii::$app->request->post('INCIDENCE_ID');
        $incidence = STUDENT_INCIDENCE::findOne(['INCIDENCE_ID' => $incidence_id]);

        $check_tracked_processes = TRACKING_MODEL::GetTrackedProcesses($incidence_id);

        if (count($check_tracked_processes) > 1):
        elseif (count($check_tracked_processes) <= 0):
        elseif (count($check_tracked_processes) == 1):
        else:
            //throw error here
        endif;
        if (count($check_tracked_processes) > 1) {
            //means we have a tracking already in progress, so redirect to actor action view
            return $this->redirect(['actor-action', 'incidence_id' => $incidence_id]);
        } else if (count($check_tracked_processes) <= 0) {
            //wrap in a transaction
            $connection = \Yii::$app->db;

            $trans = $connection->beginTransaction();
            //insert the first incidence
            $first_tracking = new TRACKING_MODEL();
            $process = PROCESS_MODEL::GetFirstProcess($incidence->CASE_TYPE_ID, false);

            $first_tracking->INCIDENCE_ID = $incidence_id;
            $first_tracking->PROCESS_ID = $process->PROCESS_ID;
            $first_tracking->COMMENTS = $process->DESCRIPTION;

            if ($first_tracking->save()) {
                $tracking_date = new TRACKING_DATE_MODEL();
                $tracking_date->TRACKING_ID = $first_tracking->TRACKING_ID;
                $tracking_date->EVENT_DATE = new Expression('SYSDATE');
                $tracking_date->COMMENTS = $first_tracking->COMMENTS;
                $tracking_date->STATUS = 'COMPLETE';
                if ($tracking_date->save()) {
                    $trans->commit();
                } else {
                    $trans->rollBack();
                }
            } else {
                $trans->rollBack();
            }
        } else {
            //first let us file the incidence and haveing been files first
            if ($tracking->load(Yii::$app->request->post())) {
                var_dump($tracking);
                return $this->refresh();
            }

            return $this->render('first-office', [
                'tracking' => $tracking,
                'process_actor' => $process_actor,
                'incidence' => $incidence
            ]);
        }

    }
}

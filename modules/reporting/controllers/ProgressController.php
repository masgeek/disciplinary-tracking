<?php

namespace app\modules\reporting\controllers;

use app\modules\tracking\extended\STUDENT_INCIDENCE;
use Yii;
use yii\db\Expression;
use yii\filters\VerbFilter;
use app\modules\reporting\models\PROCESS_ACTOR_MODEL;
use app\modules\reporting\models\TRACKING_MODEL;
use app\components\CONSTANTS;
use app\modules\reporting\models\TRACKING_DATE_MODEL;
use app\modules\setup\models\PROCESS_MODEL;


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
        /* @var $process PROCESS_MODEL */
        $user_id = yii::$app->user->id;

        $incidence_id = \Yii::$app->request->post('INCIDENCE_ID');
        if (\Yii::$app->request->post('TRACKING_MODEL')) {
            $post = \Yii::$app->request->post('TRACKING_MODEL');
            $incidence_id = $post['INCIDENCE_ID'];
        }

        $incidence = STUDENT_INCIDENCE::findOne(['INCIDENCE_ID' => $incidence_id]);

        $check_tracked_processes = TRACKING_MODEL::GetTrackedProcesses($incidence_id);

        if (count($check_tracked_processes) > 1):
            //means we have a tracking already in progress, so redirect to actor action view
            return $this->redirect(['actor-action', 'incidence_id' => $incidence_id]);
        elseif (count($check_tracked_processes) <= 0) :
            //wrap in a transaction
            $connection = \Yii::$app->db;

            $trans = $connection->beginTransaction();
            //insert the first incidence
            $first_tracking = new TRACKING_MODEL();
            $process = PROCESS_MODEL::GetNextTrackingProcess($incidence->CASE_TYPE_ID, false);

            $first_tracking->INCIDENCE_ID = $incidence_id;
            $first_tracking->PROCESS_ID = $process->PROCESS_ID;
            $first_tracking->COMMENTS = $process->DESCRIPTION;
            $first_tracking->ADDED_BY = $user_id;
            $first_tracking->ACTED_ON_BY = $user_id;
            $first_tracking->TRACKING_STATUS = CONSTANTS::STATUS_APPROVED;

            if ($first_tracking->save()):
                $tracking_date = new TRACKING_DATE_MODEL();
                $tracking_date->TRACKING_ID = $first_tracking->TRACKING_ID;
                $tracking_date->EVENT_DATE = new Expression('SYSDATE');
                $tracking_date->COMMENTS = $first_tracking->COMMENTS;
                $tracking_date->STATUS = CONSTANTS::STATUS_COMPLETE; //..mark the activity as completed
                if ($tracking_date->save()):
                    $trans->commit();
                else :
                    $trans->rollBack();
                    var_dump($tracking_date->getErrors());
                endif;
            else:
                $trans->rollBack();
                var_dump($first_tracking->getErrors());
            endif;
        endif;

        //check the next process again
        $contains_one_process = TRACKING_MODEL::GetTrackedProcesses($incidence_id);

        //if process is one lets got to foward to second office, first process is viewed as having been reported
        if (count($contains_one_process) == CONSTANTS::FIRST_PROCESS_COUNT) :
            $tracking = new TRACKING_MODEL();
            $process_actor = new PROCESS_ACTOR_MODEL();
            //first let us file the incidence and having been files first
            if ($tracking->load(Yii::$app->request->post())):
                //lets save the forwarding request
                var_dump($_POST);
            endif;
            return $this->render('first-office', [
                'tracking' => $tracking,
                'process_actor' => $process_actor,
                'incidence' => $incidence
            ]);
        else:
            throw new NotFoundHttpException('The requested page does not exist.');
        endif;
    }
}

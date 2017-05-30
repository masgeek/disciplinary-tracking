<?php

namespace app\modules\reporting\controllers;

use app\modules\reporting\models\CASE_INCIDENCE_MODEL;
use app\modules\tracking\extended\STUDENT_INCIDENCE;
use app\modules\tracking\models\TRACKING;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'first-office' => ['POST'],
                    //'next-office' => ['POST'],
                    //'incidence-summary' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionActorAction()
    {
        //$session = Yii::$app->session;

        //$incidence_id = $session->get('INCIDENCE_ID');

        //return $this->render('actor-action');
        return $this->redirect(['incidence-summary']);
    }

    public function actionNextOffice($id)
    {
        /* @var $process PROCESS_MODEL */
        /* @var $previous_tracking TRACKING_MODEL */
        $session = Yii::$app->session;
        $user_id = yii::$app->user->id;
        $connection = \Yii::$app->db;

        $incidence = STUDENT_INCIDENCE::findOne(['INCIDENCE_ID' => $id]);
        $tracking = new TRACKING_MODEL();
        $process_actor = new PROCESS_ACTOR_MODEL();

        if ($tracking->load(Yii::$app->request->post())) {
            //wrap in a transaction
            $trans = $connection->beginTransaction();
            //insert the first incidence
            $process_exclusion_arr = TRACKING_MODEL::GetTrackedProcesses($id);

            //get pending trackined process
            $previous_tracking = TRACKING_MODEL::GetPendingTrackedProcesses($id, CONSTANTS::STATUS_PENDING);

            $previous_tracking->ACTED_ON_BY = $user_id;
            $previous_tracking->TRACKING_STATUS = CONSTANTS::STATUS_APPROVED;

            if ($previous_tracking->save()) {
                //first get and update the previous tracking process
                $process = PROCESS_MODEL::GetNextTrackingProcess($incidence->CASE_TYPE_ID, false, $process_exclusion_arr);

                $tracking->INCIDENCE_ID = $id;
                $tracking->PROCESS_ID = $process->PROCESS_ID;
                $tracking->COMMENTS = $process->DESCRIPTION;
                $tracking->ADDED_BY = $user_id;
                //$tracking->ACTED_ON_BY = $user_id;
                $tracking->TRACKING_STATUS = CONSTANTS::STATUS_PENDING;

                // save the next tracking data
                if ($tracking->save()):
                    $tracking_date = new TRACKING_DATE_MODEL();
                    $tracking_date->TRACKING_ID = $tracking->TRACKING_ID;
                    $tracking_date->EVENT_DATE = new Expression('SYSDATE');
                    $tracking_date->COMMENTS = $tracking->COMMENTS;
                    $tracking_date->STATUS = CONSTANTS::STATUS_COMPLETE; //..mark the activity as completed
                    if ($tracking_date->save()):
                        $trans->commit(); //commit the transactions
                        $session->set('INCIDENCE_ID', $tracking->INCIDENCE_ID);
                        return $this->redirect(['incidence-summary']); //got the actor action
                    else :
                        $trans->rollBack();
                    var_dump($tracking_date->getErrors());
                    endif;
                else:
                    $trans->rollBack();
                var_dump($tracking->getErrors());
                endif;
            } else {
                $trans->rollBack();
                $previous_tracking->getErrors();
            }
            return 5;
        }
        //lets render the form view
        return $this->render('next-office', [
            'tracking' => $tracking,
            'process_actor' => $process_actor,
            'incidence' => $incidence
        ]);
    }

    public function actionIncidenceSummary()
    {
        $session = Yii::$app->session;
        $incidence_id = $session->get('INCIDENCE_ID');
        $student_incidence = new TRACKING_MODEL();

        $dataProvider = $student_incidence->search($incidence_id);

        return $this->render('incidence-summary', ['dataProvider' => $dataProvider]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionFirstOffice()
    {
        /* @var $process PROCESS_MODEL */
        $session = Yii::$app->session;
        $user_id = yii::$app->user->id;
        $connection = \Yii::$app->db;

        $incidence_id = \Yii::$app->request->post('INCIDENCE_ID');
        if (\Yii::$app->request->post('TRACKING_MODEL')) {
            $post = \Yii::$app->request->post('TRACKING_MODEL');
            $incidence_id = $post['INCIDENCE_ID'];
        }

        $incidence = STUDENT_INCIDENCE::findOne(['INCIDENCE_ID' => $incidence_id]);

        $check_tracked_processes = TRACKING_MODEL::GetTrackedProcesses($incidence_id);
        if (count($check_tracked_processes) > 1):
            //means we have a tracking already in progress, so redirect to actor action view
            $session->set('INCIDENCE_ID', $incidence_id);
            return $this->redirect(['incidence-summary']); //got the actor action
        //return $this->redirect(['actor-action', 'incidence_id' => $incidence_id]);
        elseif (count($check_tracked_processes) <= 0) :
            //wrap in a transaction

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
                //$session->set('INCIDENCE_ID', $first_tracking->INCIDENCE_ID);
                //return $this->redirect(['incidence-summary']); //got the actor action
                //return $this->redirect(['actor-action']); //got the actor action
                else :
                    $trans->rollBack();
                    //var_dump($tracking_date->getErrors());
                endif;
            else:
                $trans->rollBack();
                //var_dump($first_tracking->getErrors());
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
                $trans = $connection->beginTransaction();
                //lets save the forwarding request
                $tracking->ADDED_BY = $user_id;
                $tracking->ACTED_ON_BY = $user_id;
                $tracking->TRACKING_STATUS = CONSTANTS::STATUS_PENDING; //set as pending awaiting next action for the forwarded office

                if ($tracking->save()):
                    //save the tracking date information
                    $tracking_date = new TRACKING_DATE_MODEL();
                    $tracking_date->TRACKING_ID = $tracking->TRACKING_ID;
                    $tracking_date->EVENT_DATE = new Expression('SYSDATE');
                    $tracking_date->COMMENTS = $tracking->COMMENTS;
                    $tracking_date->STATUS = CONSTANTS::STATUS_COMPLETE; //..mark the activity as completed
                    if ($tracking_date->save()):
                        $trans->commit();
                        //go to the forwarding summary
                        $session->set('INCIDENCE_ID', $tracking->INCIDENCE_ID);
                        return $this->redirect(['incidence-summary']); //got the actor action
                    else :
                        $trans->rollBack();
                        //var_dump($tracking_date->getErrors());
                    endif;
                else:
                    $trans->rollBack();
                endif;
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

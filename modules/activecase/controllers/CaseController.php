<?php

namespace app\modules\activecase\controllers;

use app\modules\reporting\models\CASE_INCIDENCE_MODEL;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `activecase` module
 */
class CaseController extends Controller
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
     * Renders the active view for the module
     * @return string
     */
    public function actionAll()
    {
        return $this->render('all-cases');
    }

    public function actionProgress()
    {
        $this->view->title = 'Disciplinary Cases Progress';

        $dataProvider = new ActiveDataProvider([
            'query' => CASE_INCIDENCE_MODEL::find(),
        ]);

        return $this->render('case-progress', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Renders the active view for the module
     * @return string
     */
    public function actionPending()
    {
        $session = \Yii::$app->session;
        $this->view->title = 'My Pending Cases';

        // var_dump($session->isActive);

        //die;
        return $this->render('pending-cases');
    }

    /**
     * Renders the active view for the module
     * @return string
     */
    public function actionActive()
    {

        return $this->render('active');
    }

    /**
     * Renders the inactive view for the module
     * @return string
     */
    public function actionClosed()
    {
        return $this->render('closed');
    }
}

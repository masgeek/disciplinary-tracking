<?php

namespace app\modules\reporting\controllers;

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
        return $this->render('first-office');
    }

}

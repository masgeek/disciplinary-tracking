<?php

namespace app\modules\reporting\controllers;

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
        var_dump($_POST);
        return $this->render('first-office');
    }

}

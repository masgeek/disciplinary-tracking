<?php

namespace app\modules\reporting\controllers;

class ProgressController extends \yii\web\Controller
{
    public function actionActorAction()
    {
        return $this->render('actor-action');
    }

    public function actionFirstOffice()
    {
        return $this->render('first-office');
    }

}

<?php

namespace app\modules\activecase\controllers;

use yii\web\Controller;

/**
 * Default controller for the `activecase` module
 */
class CaseController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionActive()
    {
        return $this->render('index');
    }
}

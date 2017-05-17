<?php

namespace app\modules\activecase\controllers;

use yii\web\Controller;

/**
 * Default controller for the `activecase` module
 */
class CaseController extends Controller
{
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
        return $this->render('all-cases');
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

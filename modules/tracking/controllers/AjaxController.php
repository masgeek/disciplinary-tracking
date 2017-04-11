<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 11-Apr-17
 * Time: 16:17
 */

namespace app\modules\tracking\controllers;


use app\modules\tracking\models\UONSTUDENTS;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AjaxController extends Controller
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
                    'student-details' => ['POST'],
                ],
            ],
        ];
    }


    public function actionStudentDetails()
    {
        $student_reg_no = \Yii::$app->request->post('STUDENT_REG_NO');
        //var_dump($_POST);
        //let us fetch the student
        $data = UONSTUDENTS::find()
            ->select(['REGISTRATION_NUMBER','D_PROG_DEGREE_CODE'])
            ->where(['REGISTRATION_NUMBER' => $student_reg_no])
            ->asArray()
            ->one();//findOne(['REGISTRATION_NUMBER'=>$student_reg_no]);
        return json_encode($data);
    }
}
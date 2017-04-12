<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 11-Apr-17
 * Time: 16:17
 */

namespace app\modules\tracking\controllers;


use app\modules\tracking\extended\STUDENT_MODEL;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
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
        /* @var $data STUDENT_MODEL */
        $student_reg_no = \Yii::$app->request->post('STUDENT_REG_NO');
        //let us fetch the student
        $data = STUDENT_MODEL::find()
            //->select(['REGISTRATION_NUMBER','D_PROG_DEGREE_CODE'])
            ->where(['REGISTRATION_NUMBER' => $student_reg_no])
            ->asArray()
            //->with('dEGREEPROGRAMME')
            //->with('sTCSTUDENTCATEGORY')
            ->with('sTUDENTSTATUS')
            ->one();//findOne(['REGISTRATION_NUMBER'=>$student_reg_no]);

        var_dump($data);
        //$students_list = ArrayHelper::map($data, 'REGISTRATION_NUMBER', 'D_PROG_DEGREE_CODE');
        //var_dump($students_list);
        //return json_encode($data);
    }
}
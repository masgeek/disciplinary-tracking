<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 11-Apr-17
 * Time: 16:17
 */

namespace app\modules\tracking\controllers;


use app\modules\tracking\extended\FACULTY_MODEL;
use app\modules\tracking\extended\STUDENT_MODEL;
use app\modules\tracking\models\COLLEGES;
use yii\filters\VerbFilter;
use yii\helpers\Json;
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
            ->where(['REGISTRATION_NUMBER' => $student_reg_no])
            ->asArray()
            ->with('dEGREEPROGRAMME')
            ->with('sTUDENTCATEGORY')
            ->with('sTUDENTSTATUS')
            ->one();

        return json_encode($data);
    }

    public function actionStudentStatus()
    {

        $student_arr = ['output' => '', 'selected' => ''];

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $student_reg_no = $parents[0];
                $student = STUDENT_MODEL::GetStudentInfo($student_reg_no);

                if ($student != null && $student->sTUDENTSTATUS != null) {
                    $out = [[
                        'id' => $student->sTUDENTSTATUS->STATUS_CODE,
                        'name' => $student->sTUDENTSTATUS->STATUS_DESCRIPTION
                    ]];
                    $student_arr = ['output' => $out, 'selected' => $student->sTUDENTSTATUS->STATUS_CODE];
                }
            }
        }
        return Json::encode($student_arr);
    }

    public function actionFacultyInfo()
    {

        $faculty_arr = ['output' => '', 'selected' => ''];

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $student_reg_no = $parents[0];
                $data = STUDENT_MODEL::find()
                    ->where(['REGISTRATION_NUMBER' => $student_reg_no])
                    ->asArray()
                    ->with('dEGREEPROGRAMME')
                    ->one();

                $faculty_code = $data['dEGREEPROGRAMME']['FACUL_FAC_CODE'];

                $facultyName = FACULTY_MODEL::GetFaculty($faculty_code);
                if ($facultyName != null) {
                    $out = [[
                        'id' => $facultyName->FAC_CODE,
                        'name' => $facultyName->FACULTY_NAME
                    ]];
                    $faculty_arr = ['output' => $out, 'selected' => $faculty_code];
                }
            }
        }
        return Json::encode($faculty_arr);
    }

    public function actionCollegeInfo()
    {
        /* @var $col COLLEGES */
        $college_arr = ['output' => '', 'selected' => ''];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $faculty_code = $parents[0];
                $facultyName = FACULTY_MODEL::GetStudentFaculty($faculty_code);

                $col = (object)$facultyName['cOLCODE'];
                $out = [[
                    'id' => $col->COL_CODE,
                    'name' => $col->COL_NAME
                ]];

                $college_arr = ['output' => $out, 'selected' => $col->COL_CODE];
            }
        }
        return Json::encode($college_arr);
    }
}
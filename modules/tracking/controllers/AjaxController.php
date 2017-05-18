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

    public function actionFacultyInfo()
    {


        $out = [];
        $faculty_arr = ['output' => '', 'selected' => ''];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $student_reg_no = $parents[0];
                //$out = self::getSubCatList($student_reg_no);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]

                $data = STUDENT_MODEL::find()
                    ->where(['REGISTRATION_NUMBER' => $student_reg_no])
                    ->asArray()
                    ->with('dEGREEPROGRAMME')
                    //->with('sTUDENTCATEGORY')
                    //->with('sTUDENTSTATUS')
                    ->one();

                $faculty_code = $data['dEGREEPROGRAMME']['FACUL_FAC_CODE'];

                $facultyName = FACULTY_MODEL::GetFaculty($faculty_code);
                $out = [[
                    'id' => $facultyName->FAC_CODE,
                    'name' => $facultyName->FACULTY_NAME
                ]];

                $faculty_arr = ['output' => $out, 'selected' => "$faculty_code"];
            }
        }
        return Json::encode($faculty_arr);
    }

    public function actionCollegeInfo()
    {
        $out = [];
        $college_arr = ['output' => '', 'selected' => ''];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $student_reg_no = $parents[0];
                //$out = self::getSubCatList($student_reg_no);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]

                $data = STUDENT_MODEL::find()
                    ->where(['REGISTRATION_NUMBER' => $student_reg_no])
                    ->asArray()
                    ->with('dEGREEPROGRAMME')
                    //->with('sTUDENTCATEGORY')
                    //->with('sTUDENTSTATUS')
                    ->one();

                $faculty_code = $data['dEGREEPROGRAMME']['FACUL_FAC_CODE'];

                $facultyName = FACULTY_MODEL::GetFaculty($faculty_code);
                $out = [[
                    'id' => $facultyName->FAC_CODE,
                    'name' => $facultyName->FACULTY_NAME
                ]];

                $college_arr = ['output' => $out, 'selected' => "$faculty_code"];
            }
        }
        return Json::encode($college_arr);
    }
}
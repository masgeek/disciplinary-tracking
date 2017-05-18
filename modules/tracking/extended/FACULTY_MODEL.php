<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 12-Apr-17
 * Time: 12:13
 */

namespace app\modules\tracking\extended;


use app\modules\tracking\models\FACULTIES;
use yii\helpers\ArrayHelper;

class FACULTY_MODEL extends FACULTIES
{
    public static function GetFaculty($fac_code)
    {
        $data = self::findOne($fac_code);

        return $data;
    }

    public static function GetFaculties($dropdown = true)
    {
        $data = self::find()
            ->select(['FAC_CODE', 'FACULTY_NAME', 'COL_CODE'])
            ->with('cOLCODE')
            ->asArray()
            ->all();

        //add array class
        if ($dropdown) {
            return ArrayHelper::map($data, 'FAC_CODE', 'FACULTY_NAME');
        }

        return $data;
    }

    public static function GetStudentFaculty($dropdown = true, $depdrop = false)
    {
        $data = self::find()
            ->select(['FAC_CODE', 'FACULTY_NAME', 'COL_CODE'])
            ->with('cOLCODE')
            ->asArray()
            ->all();

        //add array class
        if ($dropdown) {
            return ArrayHelper::map($data, 'FAC_CODE', 'FACULTY_NAME');
        }

        return $data;
    }
}
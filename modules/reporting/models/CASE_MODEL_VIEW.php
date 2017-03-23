<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/15/2017
 * Time: 10:51 AM
 */

namespace app\modules\reporting\models;


use app\modules\tracking\models\CASEVIEW;
use yii\helpers\ArrayHelper;

class CASE_MODEL_VIEW extends CASEVIEW
{
    public static function GetCaseName($case_type_id)
    {
        //$list = self::findOne(['CASE_TYPE_NAME'])
        $case_name = self::findOne(['CASE_TYPE_ID' => $case_type_id]);
        return $case_name->CASE_TYPE_NAME;
    }

    public static function GetCaseNameArray($incidence_id)
    {
        echo $incidence_id;
        $process_list = self::find()->select(['CASE_TYPE_ID', 'CASE_TYPE_NAME'])
            ->where(['INCIDENCE_ID' => $incidence_id])
            ->asArray()->all();


        $case_name_list = ArrayHelper::map($process_list, 'CASE_TYPE_ID', 'CASE_TYPE_NAME');
        return $case_name_list;
    }
}
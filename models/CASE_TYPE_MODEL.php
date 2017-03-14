<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 17:40
 */

namespace app\models;


use app\modules\tracking\models\DISCIPLINARYCASETYPES;
use app\modules\tracking\models\DISCIPLINARYTYPE;
use yii\helpers\ArrayHelper;

class CASE_TYPE_MODEL extends DISCIPLINARYCASETYPES
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CASE_TYPE_NAME', 'DISCIPLINARY_TYPE_ID'], 'required'],
            [['CASE_TYPE_ID', 'DISCIPLINARY_TYPE_ID'], 'integer'],
            [['CASE_TYPE_NAME'], 'string', 'max' => 200],
            [['CASE_TYPE_ID'], 'unique'],
            [['DISCIPLINARY_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DISCIPLINARYTYPE::className(), 'targetAttribute' => ['DISCIPLINARY_TYPE_ID' => 'DISCIPLINARY_TYPE_ID']],
        ];
    }

    /**
     * return array list of disciplinary case types
     * @param $disc_id
     * @return array
     */
    public static function GetCaseTypesList($disc_id = 1)
    {
        $list = self::find()
            ->select(['CASE_TYPE_ID', 'CASE_TYPE_NAME'])
            ->where(['DISCIPLINARY_TYPE_ID' => $disc_id])
            ->asArray()
            ->all();

        //lets build the array based on teh dependednt dropdown template
        $status_code_list = array();
        foreach ($list as $value) {
            $status_code_list[] = ['id' => $value['CASE_TYPE_ID'], 'name' => $value['CASE_TYPE_NAME']];
        }
        //$status_code_list = ArrayHelper::map($list, 'CASE_TYPE_ID', 'CASE_TYPE_NAME');
        return $status_code_list;
    }
}
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
     * @param integer $disc_id
     * @param boolean $drop_down
     * @return array
     */
    public static function GetCaseTypesList($disc_id = 1, $drop_down = false)
    {
        $list = self::find()
            ->select(['CASE_TYPE_ID', 'CASE_TYPE_NAME'])
            ->where(['DISCIPLINARY_TYPE_ID' => $disc_id])
            ->asArray()
            ->all();

        //lets build the array based on the dependednt dropdown template
        if ($drop_down) {
            $status_code_list = ArrayHelper::map($list, 'CASE_TYPE_ID', 'CASE_TYPE_NAME');
        } else {
            $status_code_list = array();
            foreach ($list as $value) {
                $status_code_list[] = ['id' => $value['CASE_TYPE_ID'], 'name' => $value['CASE_TYPE_NAME']];
            }
        }
        return $status_code_list;
    }
}
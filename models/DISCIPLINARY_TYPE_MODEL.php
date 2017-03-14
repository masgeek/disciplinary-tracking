<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 17:37
 */

namespace app\models;


use app\modules\tracking\models\DISCIPLINARYTYPE;
use yii\helpers\ArrayHelper;

class DISCIPLINARY_TYPE_MODEL extends DISCIPLINARYTYPE
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DISCIPLINARY_TYPE_NAME'], 'required'],
            [['DISCIPLINARY_TYPE_ID'], 'integer'],
            [['DISCIPLINARY_TYPE_NAME'], 'string', 'max' => 200],
            [['DISCIPLINARY_TYPE_ID'], 'unique'],
        ];
    }

    public static function GetDisciplinaryTypeList()
    {
        $list = self::find()->select(['DISCIPLINARY_TYPE_ID', 'DISCIPLINARY_TYPE_NAME'])->asArray()->all();
        $disciplinary_type_list = ArrayHelper::map($list, 'DISCIPLINARY_TYPE_ID', 'DISCIPLINARY_TYPE_NAME');
        return $disciplinary_type_list;
    }
}
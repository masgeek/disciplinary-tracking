<?php
/**
 * Created by PhpStorm.
 * User: Musyoka
 * Date: 3/20/2017
 * Time: 11:59 AM
 */

namespace app\modules\setup\models;


use app\modules\tracking\models\PROCESS;
use app\modules\tracking\models\DISCIPLINARYCASETYPES;
use Yii;

class PROCESS_MODEL extends PROCESS
{
    public $DISC_TYPE_ID;

    public function rules()
    {
        return [
            [['CASE_TYPE_ID', 'PROCESS_NAME', 'ORDER_NO'], 'required'],
            [['PROCESS_ID', 'CASE_TYPE_ID', 'ORDER_NO'], 'integer'],
            [['PROCESS_NAME'], 'string', 'max' => 200],
            [['DESCRIPTION'], 'string', 'max' => 500],
            [['PROCESS_ID'], 'unique'],
            [['CASE_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DISCIPLINARYCASETYPES::className(), 'targetAttribute' => ['CASE_TYPE_ID' => 'CASE_TYPE_ID']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'PROCESS_ID' => Yii::t('app', 'Process  ID'),
            'CASE_TYPE_ID' => Yii::t('app', 'Case  Types'),
            'PROCESS_NAME' => Yii::t('app', 'Process  Name'),
            'DESCRIPTION' => Yii::t('app', 'Process Description'),
            'ORDER_NO' => Yii::t('app', 'Order  No'),
        ];
    }
}
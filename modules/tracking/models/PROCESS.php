<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "{{%PROCESS}}".
 *
 * @property integer $PROCESS_ID
 * @property integer $CASE_TYPE_ID
 * @property string $PROCESS_NAME
 * @property string $DESCRIPTION
 * @property integer $ORDER_NO
 *
 * @property DISCIPLINARYCASETYPES $cASETYPE
 * @property PROCESSACTORS[] $pROCESSACTORSs
 * @property TRACKING[] $tRACKINGs
 */
class PROCESS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%PROCESS}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROCESS_ID', 'CASE_TYPE_ID', 'PROCESS_NAME', 'ORDER_NO'], 'required'],
            [['PROCESS_ID', 'CASE_TYPE_ID', 'ORDER_NO'], 'integer'],
            [['PROCESS_NAME'], 'string', 'max' => 200],
            [['DESCRIPTION'], 'string', 'max' => 500],
            [['PROCESS_ID'], 'unique'],
            [['CASE_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DISCIPLINARYCASETYPES::className(), 'targetAttribute' => ['CASE_TYPE_ID' => 'CASE_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROCESS_ID' => Yii::t('app', 'Process  ID'),
            'CASE_TYPE_ID' => Yii::t('app', 'Case  Type  ID'),
            'PROCESS_NAME' => Yii::t('app', 'Process  Name'),
            'DESCRIPTION' => Yii::t('app', 'Description'),
            'ORDER_NO' => Yii::t('app', 'Order  No'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCASETYPE()
    {
        return $this->hasOne(DISCIPLINARYCASETYPES::className(), ['CASE_TYPE_ID' => 'CASE_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROCESSACTORSs()
    {
        return $this->hasMany(PROCESSACTORS::className(), ['PROCESS_ID' => 'PROCESS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRACKINGs()
    {
        return $this->hasMany(TRACKING::className(), ['PROCESS_ID' => 'PROCESS_ID']);
    }
}

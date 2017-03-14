<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_DISCIPLINARY_CASE_TYPES".
 *
 * @property integer $CASE_TYPE_ID
 * @property integer $DISCIPLINARY_TYPE_ID
 * @property string $CASE_TYPE_NAME
 *
 * @property DISCIPLINARYTYPE $dISCIPLINARYTYPE
 * @property PROCESS[] $pROCESSes
 */
class DISCIPLINARYCASETYPES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_DISCIPLINARY_CASE_TYPES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CASE_TYPE_ID', 'CASE_TYPE_NAME'], 'required'],
            [['CASE_TYPE_ID', 'DISCIPLINARY_TYPE_ID'], 'integer'],
            [['CASE_TYPE_NAME'], 'string', 'max' => 200],
            [['CASE_TYPE_ID'], 'unique'],
            [['DISCIPLINARY_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DISCIPLINARYTYPE::className(), 'targetAttribute' => ['DISCIPLINARY_TYPE_ID' => 'DISCIPLINARY_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CASE_TYPE_ID' => Yii::t('app', 'Case  Type  ID'),
            'DISCIPLINARY_TYPE_ID' => Yii::t('app', 'Disciplinary  Type  ID'),
            'CASE_TYPE_NAME' => Yii::t('app', 'Case  Type  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDISCIPLINARYTYPE()
    {
        return $this->hasOne(DISCIPLINARYTYPE::className(), ['DISCIPLINARY_TYPE_ID' => 'DISCIPLINARY_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROCESSes()
    {
        return $this->hasMany(PROCESS::className(), ['CASE_TYPE_ID' => 'CASE_TYPE_ID']);
    }
}

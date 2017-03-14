<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "STUDENTS_STATUS".
 *
 * @property string $STATUS_CODE
 * @property string $STATUS_DESCRIPTION
 * @property string $PRINT_TRANSCRIPT
 * @property string $CURRENT_STUDENT
 *
 * @property CASEINCIDENCES[] $cASEINCIDENCESs
 */
class STUDENTSSTATUS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'STUDENTS_STATUS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STATUS_CODE'], 'required'],
            [['STATUS_CODE'], 'string', 'max' => 8],
            [['STATUS_DESCRIPTION'], 'string', 'max' => 30],
            [['PRINT_TRANSCRIPT'], 'string', 'max' => 2],
            [['CURRENT_STUDENT'], 'string', 'max' => 12],
            [['STATUS_CODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STATUS_CODE' => Yii::t('app', 'Status  Code'),
            'STATUS_DESCRIPTION' => Yii::t('app', 'Status  Description'),
            'PRINT_TRANSCRIPT' => Yii::t('app', 'Print  Transcript'),
            'CURRENT_STUDENT' => Yii::t('app', 'Current  Student'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCASEINCIDENCESs()
    {
        return $this->hasMany(CASEINCIDENCES::className(), ['STATUS_CODE' => 'STATUS_CODE']);
    }
}

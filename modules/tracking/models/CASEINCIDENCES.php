<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_CASE_INCIDENCES".
 *
 * @property integer $INCIDENCE_ID
 * @property string $STUDENT_REG_NO
 * @property string $DATE_REPORTED
 * @property string $CASE_DESCRIPTION
 * @property string $STATUS_CODE
 * @property string $REPORTED_BY
 *
 * @property STUDENTSSTATUS $sTATUSCODE
 * @property FILEUPLOAD[] $fILEUPLOADs
 * @property STUDENTINCIDENCES[] $sTUDENTINCIDENCESs
 */
class CASEINCIDENCES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_CASE_INCIDENCES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INCIDENCE_ID', 'STUDENT_REG_NO', 'DATE_REPORTED', 'CASE_DESCRIPTION', 'STATUS_CODE', 'REPORTED_BY'], 'required'],
            [['INCIDENCE_ID'], 'integer'],
            [['DATE_REPORTED'], 'safe'],
            [['STUDENT_REG_NO', 'REPORTED_BY'], 'string', 'max' => 20],
            [['CASE_DESCRIPTION'], 'string', 'max' => 500],
            [['STATUS_CODE'], 'string', 'max' => 8],
            [['INCIDENCE_ID'], 'unique'],
            [['STATUS_CODE'], 'exist', 'skipOnError' => true, 'targetClass' => STUDENTSSTATUS::className(), 'targetAttribute' => ['STATUS_CODE' => 'STATUS_CODE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INCIDENCE_ID' => Yii::t('app', 'Incidence  ID'),
            'STUDENT_REG_NO' => Yii::t('app', 'Student  Reg  No'),
            'DATE_REPORTED' => Yii::t('app', 'Date  Reported'),
            'CASE_DESCRIPTION' => Yii::t('app', 'Case  Description'),
            'STATUS_CODE' => Yii::t('app', 'Status  Code'),
            'REPORTED_BY' => Yii::t('app', 'Reported  By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTATUSCODE()
    {
        return $this->hasOne(STUDENTSSTATUS::className(), ['STATUS_CODE' => 'STATUS_CODE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFILEUPLOADs()
    {
        return $this->hasMany(FILEUPLOAD::className(), ['INCIDENCE_ID' => 'INCIDENCE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTUDENTINCIDENCESs()
    {
        return $this->hasMany(STUDENTINCIDENCES::className(), ['INCIDENCE_ID' => 'INCIDENCE_ID']);
    }
}

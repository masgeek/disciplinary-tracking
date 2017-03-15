<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_STUDENT_INCIDENCES".
 *
 * @property integer $STUDENT_INCIDENCE_ID
 * @property integer $CASE_TYPE_ID
 * @property integer $INCIDENCE_ID
 * @property string $DATE_ADDED
 *
 * @property CASEINCIDENCES $iNCIDENCE
 */
class STUDENTINCIDENCES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_STUDENT_INCIDENCES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENT_INCIDENCE_ID', 'CASE_TYPE_ID', 'INCIDENCE_ID'], 'required'],
            [['STUDENT_INCIDENCE_ID', 'CASE_TYPE_ID', 'INCIDENCE_ID'], 'integer'],
            [['DATE_ADDED'], 'safe'],
            [['STUDENT_INCIDENCE_ID'], 'unique'],
            [['INCIDENCE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CASEINCIDENCES::className(), 'targetAttribute' => ['INCIDENCE_ID' => 'INCIDENCE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENT_INCIDENCE_ID' => Yii::t('app', 'Student  Incidence  ID'),
            'CASE_TYPE_ID' => Yii::t('app', 'Case  Type  ID'),
            'INCIDENCE_ID' => Yii::t('app', 'Incidence  ID'),
            'DATE_ADDED' => Yii::t('app', 'Date  Added'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINCIDENCE()
    {
        return $this->hasOne(CASEINCIDENCES::className(), ['INCIDENCE_ID' => 'INCIDENCE_ID']);
    }
}

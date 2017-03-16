<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_CASE_VIEW".
 *
 * @property integer $INCIDENCE_ID
 * @property integer $STUDENT_INCIDENCE_ID
 * @property string $CASE_TYPE_NAME
 * @property integer $CASE_TYPE_ID
 */
class CASEVIEW extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_CASE_VIEW';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INCIDENCE_ID', 'STUDENT_INCIDENCE_ID', 'CASE_TYPE_NAME', 'CASE_TYPE_ID'], 'required'],
            [['INCIDENCE_ID', 'STUDENT_INCIDENCE_ID', 'CASE_TYPE_ID'], 'integer'],
            [['CASE_TYPE_NAME'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INCIDENCE_ID' => Yii::t('app', 'Incidence  ID'),
            'STUDENT_INCIDENCE_ID' => Yii::t('app', 'Student  Incidence  ID'),
            'CASE_TYPE_NAME' => Yii::t('app', 'Case  Type  Name'),
            'CASE_TYPE_ID' => Yii::t('app', 'Case  Type  ID'),
        ];
    }
}

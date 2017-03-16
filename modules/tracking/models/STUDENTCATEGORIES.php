<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "STUDENT_CATEGORIES".
 *
 * @property string $STUDENT_CATEGORY_ID
 * @property string $CATEGORY_DESCRIPTION
 *
 * @property UONSTUDENTS[] $uONSTUDENTSs
 */
class STUDENTCATEGORIES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'STUDENT_CATEGORIES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENT_CATEGORY_ID', 'CATEGORY_DESCRIPTION'], 'required'],
            [['STUDENT_CATEGORY_ID'], 'string', 'max' => 5],
            [['CATEGORY_DESCRIPTION'], 'string', 'max' => 50],
            [['STUDENT_CATEGORY_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENT_CATEGORY_ID' => Yii::t('app', 'A unique code for each student category'),
            'CATEGORY_DESCRIPTION' => Yii::t('app', 'The name of the student\'s category such as undergraduate part time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUONSTUDENTSs()
    {
        return $this->hasMany(UONSTUDENTS::className(), ['STC_STUDENT_CATEGORY_ID' => 'STUDENT_CATEGORY_ID']);
    }
}

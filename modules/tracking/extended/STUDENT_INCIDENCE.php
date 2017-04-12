<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 19:59
 */

namespace app\modules\tracking\extended;


use app\modules\tracking\models\CASEINCIDENCES;
use app\modules\tracking\models\DISCIPLINARYCASETYPES;
use app\modules\tracking\models\STUDENTINCIDENCES;
use yii\db\Expression;

/**
 * Class STUDENT_INCIDENCE
 * @package app\models
 *
 * @property DISCIPLINARYCASETYPES $cASETYPE
 */
class STUDENT_INCIDENCE extends STUDENTINCIDENCES
{
    public $DISCIPLINARY_TYPE_ID;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CASE_TYPE_ID', 'INCIDENCE_ID', 'DISCIPLINARY_TYPE_ID'], 'required'],
            [['STUDENT_INCIDENCE_ID', 'CASE_TYPE_ID', 'INCIDENCE_ID'], 'integer'],
            [['STUDENT_INCIDENCE_ID'], 'unique'],
            [['CASE_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DISCIPLINARYCASETYPES::className(), 'targetAttribute' => ['CASE_TYPE_ID' => 'CASE_TYPE_ID']],
            [['INCIDENCE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CASEINCIDENCES::className(), 'targetAttribute' => ['INCIDENCE_ID' => 'INCIDENCE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DISCIPLINARY_TYPE_ID' => \Yii::t('app', 'Case Reported'),
        ];
    }

    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_ADDED = $date;
            }
            return true;
        }
        return false;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCASETYPE()
    {
        return $this->hasOne(DISCIPLINARYCASETYPES::className(), ['CASE_TYPE_ID' => 'CASE_TYPE_ID']);
    }
}
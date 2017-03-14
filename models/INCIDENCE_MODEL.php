<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 18:16
 */

namespace app\models;


use app\modules\tracking\models\CASEINCIDENCES;
use app\modules\tracking\models\STUDENTSSTATUS;
use yii\helpers\ArrayHelper;

class INCIDENCE_MODEL extends CASEINCIDENCES
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENT_REG_NO', 'DATE_REPORTED', 'CASE_DESCRIPTION', 'STATUS_CODE', 'REPORTED_BY'], 'required'],
            [['INCIDENCE_ID'], 'integer'],
            [['DATE_REPORTED'], 'safe'],
            [['STUDENT_REG_NO', 'REPORTED_BY'], 'string', 'max' => 20],
            [['CASE_DESCRIPTION'], 'string', 'max' => 4000],
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
            'STATUS_CODE' => \Yii::t('app', 'Student Status'),
        ];
    }


    public static function GetStudentsList()
    {
        $list = STUDENTS_MODEL::find()->select(['REGISTRATION_NUMBER', 'CONCAT(REGISTRATION_NUMBER,CONCAT(SURNAME,CONCAT(\' \',OTHER_NAMES))) AS NAMES'])->asArray()->all();
        $students_list = ArrayHelper::map($list, 'REGISTRATION_NUMBER', 'NAMES');
        return $students_list;
    }
}
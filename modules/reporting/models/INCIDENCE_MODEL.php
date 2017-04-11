<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 18:16
 */

namespace app\modules\reporting\models;


use app\models\STUDENTS_MODEL;
use app\modules\tracking\models\CASEINCIDENCES;
use app\modules\tracking\models\STUDENTSSTATUS;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class INCIDENCE_MODEL extends CASEINCIDENCES
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INCIDENCE_ID', 'STUDENT_REG_NO', 'CASE_DESCRIPTION', 'STATUS_CODE', 'REPORTED_BY', 'DATE_REPORTED', 'DATE_ADDED', 'FACULTY_CODE'], 'required'],
            [['INCIDENCE_ID'], 'integer'],
            [['DATE_REPORTED', 'DATE_ADDED'], 'safe'],
            [['STUDENT_REG_NO', 'REPORTED_BY', 'FACULTY_CODE'], 'string', 'max' => 20],
            [['CASE_DESCRIPTION'], 'string', 'max' => 500],
            [['STATUS_CODE'], 'string', 'max' => 8],
            [['INCIDENCE_ID'], 'unique'],
            [['STATUS_CODE'], 'exist', 'skipOnError' => true, 'targetClass' => STUDENTSSTATUS::className(), 'targetAttribute' => ['STATUS_CODE' => 'STATUS_CODE']],
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STATUS_CODE' => \Yii::t('app', \Yii::t('app', 'Student Status')),
            'FACULTY_CODE' => \Yii::t('app', \Yii::t('app', 'Faculty Name')),
        ];
    }



    public static function GetStudentsList()
    {
        $list = STUDENTS_MODEL::find()
            ->select(['REGISTRATION_NUMBER', 'CONCAT(REGISTRATION_NUMBER,CONCAT(SURNAME,CONCAT(\' \',OTHER_NAMES))) AS NAMES'])
            ->asArray()
            ->limit(10)
            ->all();
        $students_list = ArrayHelper::map($list, 'REGISTRATION_NUMBER', 'NAMES');
        return $students_list;
    }
}
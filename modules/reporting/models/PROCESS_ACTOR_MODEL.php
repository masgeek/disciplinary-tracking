<?php

namespace app\modules\reporting\models;


use Yii;
use app\modules\tracking\models\OFFICEACTORS;
use app\modules\tracking\models\PROCESS;
use app\modules\tracking\models\PROCESSACTORS;
use yii\helpers\ArrayHelper;

/**
 * Class STUDENT_INCIDENCE
 * @package app\models
 *
 * @property PROCESS $pROCESS
 * @property OFFICEACTORS $aCTORS
 */
class PROCESS_ACTOR_MODEL extends PROCESSACTORS
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROCESS_ACTOR_ID', 'OFFICE_ACTOR_ID', 'PROCESS_ID'], 'required'],
            [['PROCESS_ACTOR_ID', 'OFFICE_ACTOR_ID', 'PROCESS_ID'], 'integer'],
            [['PROCESS_ACTOR_ID'], 'unique'],
            [['PROCESS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PROCESS::className(), 'targetAttribute' => ['PROCESS_ID' => 'PROCESS_ID']],
            [['OFFICE_ACTOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OFFICEACTORS::className(), 'targetAttribute' => ['OFFICE_ACTOR_ID' => 'OFFICE_ACTOR_ID']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROCESS_ACTOR_ID' => Yii::t('app', 'Office Actor Name'),
            'OFFICE_ACTOR_ID' => Yii::t('app', 'Office Name'),
            'PROCESS_ID' => Yii::t('app', 'Process Names'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACTORS()
    {
        return $this->hasOne(OFFICEACTORS::className(), ['OFFICE_ACTOR_ID' => 'OFFICE_ACTOR_ID']);
    }

    /**
     * Get actors associated with a process
     * @param integer $process_id
     * @param string $faculty_code
     * @param bool $return_list
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function GetProcessActors($process_id, $faculty_code, $return_list = false)
    {
        $processActors = self::find()
            ->innerJoin('DT_OFFICE_ACTORS', 'DT_PROCESS_ACTORS.OFFICE_ACTOR_ID = DT_OFFICE_ACTORS.OFFICE_ACTOR_ID')
            ->where(['PROCESS_ID' => $process_id])
            ->andWhere(['DT_OFFICE_ACTORS.FACULTY_CODE' => $faculty_code])
            ->all();

        $processActorsData = $processActors;
        if ($return_list) {
            //return as array for drop-down
            $processActorsData = ArrayHelper::map($processActors, 'PROCESS_ACTOR_ID', 'aCTORS.ACTOR_NAME');
        }

        return $processActorsData;
    }
}
<?php

namespace app\modules\reporting\models;


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
     * @return \yii\db\ActiveQuery
     */
    public function getACTORS()
    {
        return $this->hasOne(OFFICEACTORS::className(), ['OFFICE_ACTOR_ID' => 'OFFICE_ACTOR_ID']);
    }

    /**
     * @param $process_id
     * @param bool $return_list
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function GetProcessActors($process_id, $return_list = false)
    {
        $processActors = self::find()
            ->where(['PROCESS_ID' => $process_id])
            //->andWhere(['ACTIVE' => CONSTANTS::STATUS_ACTIVE])
            ->with('aCTORS')//use relations in class
            ->all();

        $processActorsData = $processActors;
        if ($return_list) {
            //return as array for dropdown
            $processActorsData = ArrayHelper::map($processActors, 'PROCESS_ACTOR_ID', 'aCTORS.ACTOR_NAME');
        }

        return $processActorsData;
    }
}
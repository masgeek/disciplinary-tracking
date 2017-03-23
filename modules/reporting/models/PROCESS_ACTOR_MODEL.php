<?php

namespace app\modules\reporting\models;


use app\modules\tracking\models\OFFICEACTORS;
use app\modules\tracking\models\PROCESS;
use app\modules\tracking\models\PROCESSACTORS;

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
            [['PROCESS_ACTOR_ID'], 'required'],
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

    public static function GetProcessActors($process_id)
    {
        $processActors = self::find()
            ->where(['PROCESS_ID' => $process_id])
            ->one();

        var_dump($processActors->pROCESS);
    }
}
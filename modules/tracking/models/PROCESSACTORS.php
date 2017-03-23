<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_PROCESS_ACTORS".
 *
 * @property integer $PROCESS_ACTOR_ID
 * @property integer $OFFICE_ACTOR_ID
 * @property integer $PROCESS_ID
 *
 * @property PROCESS $pROCESS
 */
class PROCESSACTORS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_PROCESS_ACTORS';
    }

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROCESS_ACTOR_ID' => Yii::t('app', 'Process  Actor  ID'),
            'OFFICE_ACTOR_ID' => Yii::t('app', 'Office  Actor  ID'),
            'PROCESS_ID' => Yii::t('app', 'Process  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROCESS()
    {
        return $this->hasOne(PROCESS::className(), ['PROCESS_ID' => 'PROCESS_ID']);
    }
}

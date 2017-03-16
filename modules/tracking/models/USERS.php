<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_USERS".
 *
 * @property integer $USER_ID
 * @property integer $ACTOR_ID
 * @property string $PF_NO
 * @property string $ROLE
 * @property string $EMAIL_ADDRESS
 *
 * @property ACTORS $aCTOR
 */
class USERS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_USERS';
    }

    /**
    * Audit trail component
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USER_ID', 'ACTOR_ID', 'PF_NO', 'ROLE'], 'required'],
            [['USER_ID', 'ACTOR_ID'], 'integer'],
            [['PF_NO'], 'string', 'max' => 10],
            [['ROLE', 'EMAIL_ADDRESS'], 'string', 'max' => 50],
            [['USER_ID'], 'unique'],
            [['ACTOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ACTORS::className(), 'targetAttribute' => ['ACTOR_ID' => 'ACTOR_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USER_ID' => Yii::t('app', 'User  ID'),
            'ACTOR_ID' => Yii::t('app', 'Actor  ID'),
            'PF_NO' => Yii::t('app', 'Pf  No'),
            'ROLE' => Yii::t('app', 'Role'),
            'EMAIL_ADDRESS' => Yii::t('app', 'Email  Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACTOR()
    {
        return $this->hasOne(ACTORS::className(), ['ACTOR_ID' => 'ACTOR_ID']);
    }
}

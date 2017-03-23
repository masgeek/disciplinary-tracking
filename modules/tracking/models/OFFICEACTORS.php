<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_OFFICE_ACTORS".
 *
 * @property integer $OFFICE_ACTOR_ID
 * @property string $ACTOR_NAME
 * @property string $EMAIL_ADDRESS
 * @property integer $ACTIVE
 *
 * @property USERS[] $uSERSs
 */
class OFFICEACTORS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_OFFICE_ACTORS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OFFICE_ACTOR_ID', 'ACTOR_NAME', 'EMAIL_ADDRESS'], 'required'],
            [['OFFICE_ACTOR_ID', 'ACTIVE'], 'integer'],
            [['ACTOR_NAME', 'EMAIL_ADDRESS'], 'string', 'max' => 50],
            [['OFFICE_ACTOR_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OFFICE_ACTOR_ID' => Yii::t('app', 'Office  Actor  ID'),
            'ACTOR_NAME' => Yii::t('app', 'Actor  Name'),
            'EMAIL_ADDRESS' => Yii::t('app', 'Email  Address'),
            'ACTIVE' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSERSs()
    {
        return $this->hasMany(USERS::className(), ['OFFICE_ACTOR_ID' => 'OFFICE_ACTOR_ID']);
    }
}

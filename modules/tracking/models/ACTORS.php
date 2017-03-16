<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "{{%ACTORS}}".
 *
 * @property integer $ACTOR_ID
 * @property string $ACTOR_NAME
 * @property string $EMAIL_ADDRESS
 * @property integer $ACTIVE
 *
 * @property USERS[] $uSERSs
 */
class ACTORS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ACTORS}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACTOR_ID', 'ACTOR_NAME', 'EMAIL_ADDRESS'], 'required'],
            [['ACTOR_ID', 'ACTIVE'], 'integer'],
            [['ACTOR_NAME', 'EMAIL_ADDRESS'], 'string', 'max' => 50],
            [['ACTOR_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACTOR_ID' => Yii::t('app', 'Actor  ID'),
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
        return $this->hasMany(USERS::className(), ['ACTOR_ID' => 'ACTOR_ID']);
    }
}

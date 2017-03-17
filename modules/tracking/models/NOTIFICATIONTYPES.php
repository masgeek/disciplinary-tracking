<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "{{%NOTIFICATION_TYPES}}".
 *
 * @property integer $NOTIFICATION_TYPE_ID
 * @property integer $RECIPIENT_TYPE_ID
 * @property string $NOTIFICATION_NAME
 *
 * @property NOTIFICATIONS[] $nOTIFICATIONSs
 * @property RECIPIENTTYPES $rECIPIENTTYPE
 */
class NOTIFICATIONTYPES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%NOTIFICATION_TYPES}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOTIFICATION_TYPE_ID', 'NOTIFICATION_NAME'], 'required'],
            [['NOTIFICATION_TYPE_ID', 'RECIPIENT_TYPE_ID'], 'integer'],
            [['NOTIFICATION_NAME'], 'string', 'max' => 8],
            [['NOTIFICATION_TYPE_ID'], 'unique'],
            [['RECIPIENT_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => RECIPIENTTYPES::className(), 'targetAttribute' => ['RECIPIENT_TYPE_ID' => 'RECIPIENT_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NOTIFICATION_TYPE_ID' => Yii::t('app', 'Notification  Type  ID'),
            'RECIPIENT_TYPE_ID' => Yii::t('app', 'Recipient  Type  ID'),
            'NOTIFICATION_NAME' => Yii::t('app', 'Notification  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOTIFICATIONSs()
    {
        return $this->hasMany(NOTIFICATIONS::className(), ['NOTIFICATION_TYPE_ID' => 'NOTIFICATION_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRECIPIENTTYPE()
    {
        return $this->hasOne(RECIPIENTTYPES::className(), ['RECIPIENT_TYPE_ID' => 'RECIPIENT_TYPE_ID']);
    }
}

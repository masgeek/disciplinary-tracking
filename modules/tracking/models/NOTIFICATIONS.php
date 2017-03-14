<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_NOTIFICATIONS".
 *
 * @property integer $NOTIFICATION_ID
 * @property integer $NOTIFICATION_TYPE_ID
 * @property string $RECIPIENT
 * @property string $MESSAGE_TYPE
 * @property integer $STATUS
 * @property string $DATE_SENT
 *
 * @property NOTIFICATIONTYPES $nOTIFICATIONTYPE
 */
class NOTIFICATIONS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_NOTIFICATIONS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOTIFICATION_ID', 'RECIPIENT', 'MESSAGE_TYPE'], 'required'],
            [['NOTIFICATION_ID', 'NOTIFICATION_TYPE_ID', 'STATUS'], 'integer'],
            [['DATE_SENT'], 'safe'],
            [['RECIPIENT'], 'string', 'max' => 30],
            [['MESSAGE_TYPE'], 'string', 'max' => 10],
            [['NOTIFICATION_ID'], 'unique'],
            [['NOTIFICATION_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => NOTIFICATIONTYPES::className(), 'targetAttribute' => ['NOTIFICATION_TYPE_ID' => 'NOTIFICATION_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NOTIFICATION_ID' => Yii::t('app', 'Notification  ID'),
            'NOTIFICATION_TYPE_ID' => Yii::t('app', 'Notification  Type  ID'),
            'RECIPIENT' => Yii::t('app', 'Recipient'),
            'MESSAGE_TYPE' => Yii::t('app', 'COULD BE SMS , EMAIL OR WHATEVER'),
            'STATUS' => Yii::t('app', 'SENT 1 NOT SENT 0 2 DELETED'),
            'DATE_SENT' => Yii::t('app', 'Date  Sent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOTIFICATIONTYPE()
    {
        return $this->hasOne(NOTIFICATIONTYPES::className(), ['NOTIFICATION_TYPE_ID' => 'NOTIFICATION_TYPE_ID']);
    }
}

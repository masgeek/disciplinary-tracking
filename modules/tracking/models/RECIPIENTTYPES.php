<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_RECIPIENT_TYPES".
 *
 * @property integer $RECIPIENT_TYPE_ID
 * @property string $RECIPIENT_TYPE_NAME
 *
 * @property NOTIFICATIONTYPES[] $nOTIFICATIONTYPESs
 */
class RECIPIENTTYPES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_RECIPIENT_TYPES';
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
            [['RECIPIENT_TYPE_ID', 'RECIPIENT_TYPE_NAME'], 'required'],
            [['RECIPIENT_TYPE_ID'], 'integer'],
            [['RECIPIENT_TYPE_NAME'], 'string', 'max' => 15],
            [['RECIPIENT_TYPE_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RECIPIENT_TYPE_ID' => Yii::t('app', 'Recipient  Type  ID'),
            'RECIPIENT_TYPE_NAME' => Yii::t('app', 'Recipient  Type  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOTIFICATIONTYPESs()
    {
        return $this->hasMany(NOTIFICATIONTYPES::className(), ['RECIPIENT_TYPE_ID' => 'RECIPIENT_TYPE_ID']);
    }
}

<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "{{%TRACKING}}".
 *
 * @property integer $TRACKING_ID
 * @property integer $INCIDENCE_ID
 * @property integer $PROCESS_ID
 * @property string $COMMENTS
 * @property string $DATE_RECEIVED
 * @property integer $TRACKING_STATUS
 *
 * @property PROCESS $pROCESS
 * @property TRACKINGDATES[] $tRACKINGDATESs
 */
class TRACKING extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%TRACKING}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRACKING_ID'], 'required'],
            [['TRACKING_ID', 'INCIDENCE_ID', 'PROCESS_ID', 'TRACKING_STATUS'], 'integer'],
            [['DATE_RECEIVED'], 'safe'],
            [['COMMENTS'], 'string', 'max' => 500],
            [['TRACKING_ID'], 'unique'],
            [['PROCESS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PROCESS::className(), 'targetAttribute' => ['PROCESS_ID' => 'PROCESS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRACKING_ID' => Yii::t('app', 'Tracking  ID'),
            'INCIDENCE_ID' => Yii::t('app', 'Incidence  ID'),
            'PROCESS_ID' => Yii::t('app', 'Process  ID'),
            'COMMENTS' => Yii::t('app', 'Comments'),
            'DATE_RECEIVED' => Yii::t('app', 'Date  Received'),
            'TRACKING_STATUS' => Yii::t('app', 'Tracking  Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROCESS()
    {
        return $this->hasOne(PROCESS::className(), ['PROCESS_ID' => 'PROCESS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRACKINGDATESs()
    {
        return $this->hasMany(TRACKINGDATES::className(), ['TRACKING_ID' => 'TRACKING_ID']);
    }
}

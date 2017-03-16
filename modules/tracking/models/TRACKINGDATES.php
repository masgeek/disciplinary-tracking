<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "{{%TRACKING_DATES}}".
 *
 * @property integer $TRACKING_DATE_ID
 * @property integer $TRACKING_ID
 * @property string $EVENT_DATE
 * @property string $COMMENTS
 * @property string $STATUS
 * @property string $DATE_ADDED
 * @property string $DATE_MODIFIED
 *
 * @property TRACKING $tRACKING
 */
class TRACKINGDATES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%TRACKING_DATES}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRACKING_DATE_ID', 'EVENT_DATE', 'COMMENTS'], 'required'],
            [['TRACKING_DATE_ID', 'TRACKING_ID'], 'integer'],
            [['EVENT_DATE', 'DATE_ADDED', 'DATE_MODIFIED'], 'safe'],
            [['COMMENTS'], 'string', 'max' => 500],
            [['STATUS'], 'string', 'max' => 10],
            [['TRACKING_DATE_ID'], 'unique'],
            [['TRACKING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TRACKING::className(), 'targetAttribute' => ['TRACKING_ID' => 'TRACKING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRACKING_DATE_ID' => Yii::t('app', 'Tracking  Date  ID'),
            'TRACKING_ID' => Yii::t('app', 'Tracking  ID'),
            'EVENT_DATE' => Yii::t('app', 'Event  Date'),
            'COMMENTS' => Yii::t('app', 'Comments'),
            'STATUS' => Yii::t('app', 'Status'),
            'DATE_ADDED' => Yii::t('app', 'Date  Added'),
            'DATE_MODIFIED' => Yii::t('app', 'Date  Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRACKING()
    {
        return $this->hasOne(TRACKING::className(), ['TRACKING_ID' => 'TRACKING_ID']);
    }
}

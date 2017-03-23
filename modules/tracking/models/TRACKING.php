<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_TRACKING".
 *
 * @property integer $TRACKING_ID
 * @property integer $INCIDENCE_ID
 * @property integer $PROCESS_ID
 * @property string $COMMENTS
 * @property integer $TRACKING_STATUS
 * @property string $ADDED_BY
 * @property string $ACTED_ON_BY
 * @property string $DATE_RECEIVED
 * @property string $DATE_UPDATED
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
        return 'DT_TRACKING';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRACKING_ID', 'INCIDENCE_ID', 'PROCESS_ID', 'TRACKING_STATUS', 'ADDED_BY'], 'required'],
            [['TRACKING_ID', 'INCIDENCE_ID', 'PROCESS_ID', 'TRACKING_STATUS'], 'integer'],
            [['DATE_RECEIVED', 'DATE_UPDATED'], 'safe'],
            [['COMMENTS'], 'string', 'max' => 500],
            [['ADDED_BY', 'ACTED_ON_BY'], 'string', 'max' => 20],
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
            'TRACKING_STATUS' => Yii::t('app', 'Tracking  Status'),
            'ADDED_BY' => Yii::t('app', 'Added  By'),
            'ACTED_ON_BY' => Yii::t('app', 'Acted  On  By'),
            'DATE_RECEIVED' => Yii::t('app', 'Date  Received'),
            'DATE_UPDATED' => Yii::t('app', 'Date  Updated'),
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

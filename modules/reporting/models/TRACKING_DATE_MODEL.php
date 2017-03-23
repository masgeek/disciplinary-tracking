<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/23/2017
 * Time: 11:48 AM
 */

namespace app\modules\reporting\models;


use app\modules\tracking\models\TRACKING;
use app\modules\tracking\models\TRACKINGDATES;
use yii\db\Expression;

class TRACKING_DATE_MODEL extends TRACKINGDATES
{
    public function rules()
    {
        return [
            [['EVENT_DATE', 'COMMENTS'], 'required'],
            [['TRACKING_DATE_ID', 'TRACKING_ID', 'STATUS'], 'integer'],
            [['EVENT_DATE', 'DATE_ADDED', 'DATE_MODIFIED'], 'safe'],
            [['COMMENTS'], 'string', 'max' => 500],
            [['TRACKING_DATE_ID'], 'unique'],
            [['TRACKING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TRACKING::className(), 'targetAttribute' => ['TRACKING_ID' => 'TRACKING_ID']],
        ];
    }

    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');


        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_ADDED = $date;
            }
            $this->DATE_MODIFIED = $date;
            return true;
        }
        return false;
    }
}
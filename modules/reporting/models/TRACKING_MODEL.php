<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/20/2017
 * Time: 12:32 PM
 */

namespace app\modules\reporting\models;


use app\modules\tracking\models\PROCESS;
use app\modules\tracking\models\TRACKING;
use yii\db\Expression;

class TRACKING_MODEL extends TRACKING
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INCIDENCE_ID', 'PROCESS_ID'], 'required'],
            [['TRACKING_ID', 'INCIDENCE_ID', 'PROCESS_ID', 'TRACKING_STATUS'], 'integer'],
            [['DATE_RECEIVED', 'DATE_UPDATED'], 'safe'],
            [['COMMENTS'], 'string', 'max' => 1000],
            [['TRACKING_ID'], 'unique'],
            [['PROCESS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PROCESS::className(), 'targetAttribute' => ['PROCESS_ID' => 'PROCESS_ID']],
        ];
    }

    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_RECEIVED = $date;
                $this->TRACKING_STATUS = 1; //1 for active
            }
            return true;
        }
        return false;
    }


    public static function GetFirstProcess($case_type_id)
    {
        $process = PROCESS_MODEL::find()
            ->select('ORDER_NO', 'PROCESS_NAME')
            ->where(['CASE_TYPE_ID' => $case_type_id])
            ->all();

        return $process;
    }
}
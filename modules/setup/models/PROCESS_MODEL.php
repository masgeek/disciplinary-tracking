<?php
/**
 * Created by PhpStorm.
 * User: Musyoka
 * Date: 3/20/2017
 * Time: 11:59 AM
 */

namespace app\modules\setup\models;


use app\modules\tracking\models\PROCESS;
use app\modules\tracking\models\DISCIPLINARYCASETYPES;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class PROCESS_MODEL extends PROCESS
{
    public $DISC_TYPE_ID;

    public function rules()
    {
        return [
            [['CASE_TYPE_ID', 'PROCESS_NAME', 'ORDER_NO'], 'required'],
            [['PROCESS_ID', 'CASE_TYPE_ID', 'ORDER_NO'], 'integer'],
            [['PROCESS_NAME'], 'string', 'max' => 200],
            [['DESCRIPTION'], 'string', 'max' => 500],
            [['PROCESS_ID'], 'unique'],
            [['CASE_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DISCIPLINARYCASETYPES::className(), 'targetAttribute' => ['CASE_TYPE_ID' => 'CASE_TYPE_ID']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'PROCESS_ID' => Yii::t('app', 'Process ID'),
            'CASE_TYPE_ID' => Yii::t('app', 'Case Types'),
            'PROCESS_NAME' => Yii::t('app', 'Process Name'),
            'DESCRIPTION' => Yii::t('app', 'Process Description'),
            'ORDER_NO' => Yii::t('app', 'Order No'),
        ];
    }

    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');


        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_ADDED = $date;
                //$this->ORDER_NO = $this->SelectLastOrder($this->CASE_TYPE_ID);
            }
            $this->DATE_MODIFIED = $date;
            return true;
        }
        return false;
    }

    /**
     * Auto generates the next order based on the last order id
     * @param $case_type_id
     * @return int|mixed
     */
    private function SelectLastOrder($case_type_id)
    {
        $model = self::find(['CASE_TYPE_ID' => $case_type_id])
            ->select(['ORDER_NO'])
            ->orderBy(['ORDER_NO' => SORT_DESC])
            ->one();
        if ($model != null) {
            $last_order_no = $model->ORDER_NO;
            $next_order = $last_order_no + 1;
        } else {
            $next_order = 1;
        }

        return $next_order;
    }


    /**
     * Get the next process for approval/submission
     * @param integer $case_type_id
     * @param boolean $return_array
     * @param array $processes_arr
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function GetNextTrackingProcess($case_type_id, $return_array = true, $processes_arr = [])
    {
        if (!is_array($processes_arr)) {
            throw new \InvalidArgumentException("Not an array");
        }
        $process_list = self::find()->select(['PROCESS_ID', 'PROCESS_NAME','DESCRIPTION'])
            ->where(['CASE_TYPE_ID' => $case_type_id])
            ->andWhere(['NOT IN', 'PROCESS_ID', $processes_arr,])
            ->orderBy(['ORDER_NO' => SORT_ASC]);

        if ($return_array) {
            $first_process_list = ArrayHelper::map($process_list->asArray()->one(), 'PROCESS_ID', 'PROCESS_NAME');
            return $first_process_list;
        }

        return $process_list->one();
    }
}
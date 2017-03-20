<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/17/2017
 * Time: 1:42 PM
 */

namespace app\modules\reporting\models;


use app\modules\tracking\models\DISCIPLINARYCASETYPES;
use app\modules\tracking\models\PROCESS;
use yii\db\Expression;
use Yii;

class PROCESS_MODEL extends PROCESS
{

    public function behaviors()
    {
        return [
            'sortable' => [
                'class' => \kotchuprik\sortable\behaviors\Sortable::className(),
                'query' => self::find(),
                'orderAttribute' => 'ORDER_NO'
            ],
        ];
    }

    //public $id;
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CASE_TYPE_ID' => Yii::t('app', 'Case Type'),
            'PROCESS_NAME' => Yii::t('app', 'Process Name'),
            'DESCRIPTION' => Yii::t('app', 'Description'),
            'ORDER_NO' => Yii::t('app', 'Workflow Order'),
        ];
    }

    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');


        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_ADDED = $date;
                $this->ORDER_NO = $this->SelectLastOrder($this->CASE_TYPE_ID);
            }
            $this->DATE_MODIFIED = $date;
            return true;
        }
        return false;
    }

    private function SelectLastOrder($case_type_id)
    {
        $model = self::find(['CASE_TYPE_ID' => $case_type_id])
            ->select(['ORDER_NO'])
            ->orderBy(['ORDER_NO' => SORT_DESC])
            ->one();

        $last_order_no = $model->ORDER_NO;
        $next_order = $last_order_no + 1;

        return $next_order;
    }
}
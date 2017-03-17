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

class PROCESS_MODEL extends PROCESS
{

    public function behaviors()
    {
        return [
            'sortable' => [
                'class' => \kotchuprik\sortable\behaviors\Sortable::className(),
                'query' => self::find(),
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
}
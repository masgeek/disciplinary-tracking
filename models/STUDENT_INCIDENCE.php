<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 19:59
 */

namespace app\models;


use app\modules\tracking\models\CASEINCIDENCES;
use app\modules\tracking\models\DISCIPLINARYCASETYPES;
use app\modules\tracking\models\STUDENTINCIDENCES;

/**
 * Class STUDENT_INCIDENCE
 * @package app\models
 */
class STUDENT_INCIDENCE extends STUDENTINCIDENCES
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CASE_TYPE_ID', 'INCIDENCE_ID'], 'required'],
            [['STUDENT_INCIDENCE_ID', 'CASE_TYPE_ID', 'INCIDENCE_ID'], 'integer'],
            [['STUDENT_INCIDENCE_ID'], 'unique'],
            [['INCIDENCE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CASEINCIDENCES::className(), 'targetAttribute' => ['INCIDENCE_ID' => 'INCIDENCE_ID']],
            [['INCIDENCE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CASEINCIDENCES::className(), 'targetAttribute' => ['INCIDENCE_ID' => 'INCIDENCE_ID']],
        ];
    }

}
<?php

namespace app\models;

use app\modules\tracking\models\UONSTUDENTS;

/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 01:14
 */
class STUDENTS_MODEL extends UONSTUDENTS
{
    function getFullName()
    {
        return $this->SURNAME.' '.$this->OTHER_NAMES;
    }
}
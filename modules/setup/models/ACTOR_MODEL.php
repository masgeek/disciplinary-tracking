<?php
/**
 * Created by PhpStorm.
 * User: Musyoka
 * Date: 3/14/2017
 * Time: 12:08 PM
 */

namespace app\modules\setup\models;


use app\modules\tracking\models\OFFICEACTORS;

class ACTOR_MODEL extends OFFICEACTORS
{
    public function rules()
    {
        return [
            [['ACTOR_NAME', 'EMAIL_ADDRESS', 'FACULTY_SCHOOL', 'DEPARTMENT'], 'required'],
            [['OFFICE_ACTOR_ID'], 'integer'],
            [['ACTIVE'], 'number'],
            [['ACTOR_NAME', 'EMAIL_ADDRESS'], 'string', 'max' => 50],
            [['FACULTY_SCHOOL', 'DEPARTMENT'], 'string', 'max' => 20],
            [['OFFICE_ACTOR_ID'], 'unique'],
        ];
    }

}
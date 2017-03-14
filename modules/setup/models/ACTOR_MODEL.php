<?php
/**
 * Created by PhpStorm.
 * User: Musyoka
 * Date: 3/14/2017
 * Time: 12:08 PM
 */

namespace app\modules\setup\models;


use app\modules\tracking\models\ACTORS;

class ACTOR_MODEL extends ACTORS
{
    public function rules()
    {
        return [
            [['ACTOR_NAME', 'EMAIL_ADDRESS'], 'required'],
            [['ACTOR_ID', 'ACTIVE'], 'integer'],
            [['ACTOR_NAME', 'EMAIL_ADDRESS'], 'string', 'max' => 50],
            [['ACTOR_ID'], 'unique'],
        ];
    }

}
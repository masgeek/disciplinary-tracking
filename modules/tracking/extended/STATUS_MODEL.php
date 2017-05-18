<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 18:44
 */

namespace app\modules\tracking\extended;


use app\modules\tracking\models\STUDENTSSTATUS;
use yii\helpers\ArrayHelper;

class STATUS_MODEL extends STUDENTSSTATUS
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STATUS_CODE' => Yii::t('app', 'Student Status'),
        ];
    }

    public static function GetStatusList()
    {
        $list = self::find()->select(['STATUS_CODE', 'STATUS_DESCRIPTION'])->asArray()->all();
        $status_code_list = ArrayHelper::map($list, 'STATUS_CODE', 'STATUS_DESCRIPTION');
        return $status_code_list;
    }
}
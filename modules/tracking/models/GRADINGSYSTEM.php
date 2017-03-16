<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "GRADINGSYSTEM".
 *
 * @property integer $GRADINGCODE
 * @property string $GRADINGNAME
 */
class GRADINGSYSTEM extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'GRADINGSYSTEM';
    }

    /**
    * Audit trail component
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GRADINGCODE', 'GRADINGNAME'], 'required'],
            [['GRADINGCODE'], 'integer'],
            [['GRADINGNAME'], 'string', 'max' => 20],
            [['GRADINGCODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GRADINGCODE' => Yii::t('app', 'Gradingcode'),
            'GRADINGNAME' => Yii::t('app', 'Gradingname'),
        ];
    }
}

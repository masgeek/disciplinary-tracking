<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "COUNTRIES".
 *
 * @property string $COUNTRY_CODE
 * @property string $COUNTRY_NAME
 * @property string $NATIONALITY
 * @property string $ZIP_CODE
 *
 * @property HRLOCATIONS[] $hRLOCATIONSs
 */
class COUNTRIES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'COUNTRIES';
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
            [['COUNTRY_CODE', 'COUNTRY_NAME', 'NATIONALITY'], 'required'],
            [['COUNTRY_CODE'], 'string', 'max' => 5],
            [['COUNTRY_NAME', 'NATIONALITY'], 'string', 'max' => 20],
            [['ZIP_CODE'], 'string', 'max' => 10],
            [['COUNTRY_CODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COUNTRY_CODE' => Yii::t('app', 'Country  Code'),
            'COUNTRY_NAME' => Yii::t('app', 'Country  Name'),
            'NATIONALITY' => Yii::t('app', 'Nationality'),
            'ZIP_CODE' => Yii::t('app', 'Zip  Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHRLOCATIONSs()
    {
        return $this->hasMany(HRLOCATIONS::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }
}

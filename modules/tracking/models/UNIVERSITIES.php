<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "UNIVERSITIES".
 *
 * @property string $UNIVERISTY_CODE
 * @property string $UNIVERSITY_NAME
 *
 * @property COLLEGES[] $cOLLEGESs
 * @property DEGREEPROGRAMMES[] $dEGREEPROGRAMMESs
 */
class UNIVERSITIES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UNIVERSITIES';
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
            [['UNIVERISTY_CODE', 'UNIVERSITY_NAME'], 'required'],
            [['UNIVERISTY_CODE'], 'string', 'max' => 5],
            [['UNIVERSITY_NAME'], 'string', 'max' => 50],
            [['UNIVERISTY_CODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNIVERISTY_CODE' => Yii::t('app', 'A unique code for the unversity, eg. UON'),
            'UNIVERSITY_NAME' => Yii::t('app', 'The official name of the university'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOLLEGESs()
    {
        return $this->hasMany(COLLEGES::className(), ['UNIVERSITY_CODE' => 'UNIVERISTY_CODE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEGREEPROGRAMMESs()
    {
        return $this->hasMany(DEGREEPROGRAMMES::className(), ['UNIV_UNIVERISTY_CODE' => 'UNIVERISTY_CODE']);
    }
}

<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "FACULTIES".
 *
 * @property string $COL_CODE
 * @property string $FAC_CODE
 * @property string $FACULTY_NAME
 * @property string $TEL_NO
 * @property string $FAX_NO
 * @property string $EMAIL
 * @property string $URL
 * @property string $PHYSICAL_LOCATION
 * @property string $PO_BOX_ADDRESS
 * @property string $DEAN_OF_FACULTY
 * @property string $FAC_TYPE
 * @property string $DEG_INITIAL
 * @property string $FAC_HEAD
 * @property string $ONLINE_SUPPORT
 *
 * @property COLLEGES $cOLCODE
 */
class FACULTIES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'FACULTIES';
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
            [['COL_CODE', 'FAC_CODE', 'FACULTY_NAME'], 'required'],
            [['COL_CODE'], 'string', 'max' => 6],
            [['FAC_CODE'], 'string', 'max' => 3],
            [['FACULTY_NAME', 'DEAN_OF_FACULTY'], 'string', 'max' => 60],
            [['TEL_NO', 'FAX_NO', 'EMAIL'], 'string', 'max' => 30],
            [['URL'], 'string', 'max' => 100],
            [['PHYSICAL_LOCATION'], 'string', 'max' => 80],
            [['PO_BOX_ADDRESS'], 'string', 'max' => 40],
            [['FAC_TYPE', 'ONLINE_SUPPORT'], 'string', 'max' => 12],
            [['DEG_INITIAL'], 'string', 'max' => 10],
            [['FAC_HEAD'], 'string', 'max' => 20],
            [['FAC_CODE'], 'unique'],
            [['COL_CODE'], 'exist', 'skipOnError' => true, 'targetClass' => COLLEGES::className(), 'targetAttribute' => ['COL_CODE' => 'COL_CODE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COL_CODE' => Yii::t('app', 'Col  Code'),
            'FAC_CODE' => Yii::t('app', 'Fac  Code'),
            'FACULTY_NAME' => Yii::t('app', 'Faculty  Name'),
            'TEL_NO' => Yii::t('app', 'Tel  No'),
            'FAX_NO' => Yii::t('app', 'Fax  No'),
            'EMAIL' => Yii::t('app', 'Email'),
            'URL' => Yii::t('app', 'Url'),
            'PHYSICAL_LOCATION' => Yii::t('app', 'Physical  Location'),
            'PO_BOX_ADDRESS' => Yii::t('app', 'Po  Box  Address'),
            'DEAN_OF_FACULTY' => Yii::t('app', 'Dean  Of  Faculty'),
            'FAC_TYPE' => Yii::t('app', 'Fac  Type'),
            'DEG_INITIAL' => Yii::t('app', 'Deg  Initial'),
            'FAC_HEAD' => Yii::t('app', 'Fac  Head'),
            'ONLINE_SUPPORT' => Yii::t('app', 'Online  Support'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOLCODE()
    {
        return $this->hasOne(COLLEGES::className(), ['COL_CODE' => 'COL_CODE']);
    }
}

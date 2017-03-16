<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "COLLEGES".
 *
 * @property string $COL_CODE
 * @property string $COL_NAME
 * @property string $PHY_LOCATION
 * @property string $TEL_NO
 * @property string $EMAIL
 * @property string $FAX_NO
 * @property string $UNIVERSITY_CODE
 * @property string $COL_ACCT
 * @property string $COL_TYPE
 * @property string $PROFILE_URL
 * @property string $ACCOUNT_NO
 * @property string $COLLEGE_HEAD
 *
 * @property UNIVERSITIES $uNIVERSITYCODE
 * @property FACULTIES[] $fACULTIESs
 */
class COLLEGES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'COLLEGES';
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
            [['COL_CODE', 'COL_NAME', 'PHY_LOCATION'], 'required'],
            [['COL_CODE'], 'string', 'max' => 6],
            [['COL_NAME'], 'string', 'max' => 100],
            [['PHY_LOCATION', 'EMAIL'], 'string', 'max' => 40],
            [['TEL_NO', 'FAX_NO'], 'string', 'max' => 15],
            [['UNIVERSITY_CODE'], 'string', 'max' => 5],
            [['COL_ACCT'], 'string', 'max' => 20],
            [['COL_TYPE'], 'string', 'max' => 12],
            [['PROFILE_URL'], 'string', 'max' => 120],
            [['ACCOUNT_NO'], 'string', 'max' => 30],
            [['COLLEGE_HEAD'], 'string', 'max' => 60],
            [['COL_CODE'], 'unique'],
            [['UNIVERSITY_CODE'], 'exist', 'skipOnError' => true, 'targetClass' => UNIVERSITIES::className(), 'targetAttribute' => ['UNIVERSITY_CODE' => 'UNIVERISTY_CODE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COL_CODE' => Yii::t('app', 'Col  Code'),
            'COL_NAME' => Yii::t('app', 'Col  Name'),
            'PHY_LOCATION' => Yii::t('app', 'Phy  Location'),
            'TEL_NO' => Yii::t('app', 'Tel  No'),
            'EMAIL' => Yii::t('app', 'Email'),
            'FAX_NO' => Yii::t('app', 'Fax  No'),
            'UNIVERSITY_CODE' => Yii::t('app', 'University  Code'),
            'COL_ACCT' => Yii::t('app', 'Col  Acct'),
            'COL_TYPE' => Yii::t('app', 'Col  Type'),
            'PROFILE_URL' => Yii::t('app', 'Profile  Url'),
            'ACCOUNT_NO' => Yii::t('app', 'Account  No'),
            'COLLEGE_HEAD' => Yii::t('app', 'College  Head'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUNIVERSITYCODE()
    {
        return $this->hasOne(UNIVERSITIES::className(), ['UNIVERISTY_CODE' => 'UNIVERSITY_CODE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFACULTIESs()
    {
        return $this->hasMany(FACULTIES::className(), ['COL_CODE' => 'COL_CODE']);
    }
}

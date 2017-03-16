<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DEGREE_PROGRAMMES".
 *
 * @property string $DEGREE_CODE
 * @property string $DEGREE_NAME
 * @property string $DEGREE_TYPE
 * @property integer $DURATION
 * @property string $UNIV_UNIVERISTY_CODE
 * @property string $FACUL_FAC_CODE
 * @property string $CLUST_CLUSTER_NUMBER
 * @property integer $GRADINGSYSTEM
 * @property string $DEGREE_URL
 * @property string $PROG_TYPE
 * @property string $FULL_NAME
 * @property string $DEG_MODE
 * @property integer $COURSE_REG_TYPE
 * @property string $PHYSICAL_LOCATION
 * @property integer $BILLABLE
 * @property string $DEG_PREFIX
 * @property string $DEGREE_STATUS
 * @property integer $TRANSCRIPT_FACTOR
 * @property string $PASS_MARK
 * @property string $BILLING_START_YEAR
 * @property integer $ANNUAL_SEMESTERS
 * @property integer $MAX_UNITS
 * @property string $ONLINE_SUPPORT
 * @property string $AWARD_ROUNDING
 * @property string $AVERAGE_TYPE
 * @property integer $BILLING_TYPE
 *
 * @property UNIVERSITIES $uNIVUNIVERISTYCODE
 */
class DEGREEPROGRAMMES extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DEGREE_PROGRAMMES';
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
            [['DEGREE_CODE', 'DEGREE_NAME', 'DEGREE_TYPE', 'DURATION', 'UNIV_UNIVERISTY_CODE', 'FACUL_FAC_CODE', 'CLUST_CLUSTER_NUMBER', 'GRADINGSYSTEM', 'DEG_PREFIX'], 'required'],
            [['DURATION', 'GRADINGSYSTEM', 'COURSE_REG_TYPE', 'BILLABLE', 'TRANSCRIPT_FACTOR', 'ANNUAL_SEMESTERS', 'MAX_UNITS', 'BILLING_TYPE'], 'integer'],
            [['PASS_MARK'], 'number'],
            [['DEGREE_CODE', 'UNIV_UNIVERISTY_CODE', 'CLUST_CLUSTER_NUMBER'], 'string', 'max' => 5],
            [['DEGREE_NAME'], 'string', 'max' => 100],
            [['DEGREE_TYPE'], 'string', 'max' => 40],
            [['FACUL_FAC_CODE'], 'string', 'max' => 3],
            [['DEGREE_URL', 'FULL_NAME'], 'string', 'max' => 120],
            [['PROG_TYPE', 'BILLING_START_YEAR', 'AWARD_ROUNDING', 'AVERAGE_TYPE'], 'string', 'max' => 20],
            [['DEG_MODE'], 'string', 'max' => 16],
            [['PHYSICAL_LOCATION'], 'string', 'max' => 150],
            [['DEG_PREFIX', 'ONLINE_SUPPORT'], 'string', 'max' => 12],
            [['DEGREE_STATUS'], 'string', 'max' => 30],
            [['DEGREE_CODE'], 'unique'],
            [['UNIV_UNIVERISTY_CODE'], 'exist', 'skipOnError' => true, 'targetClass' => UNIVERSITIES::className(), 'targetAttribute' => ['UNIV_UNIVERISTY_CODE' => 'UNIVERISTY_CODE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DEGREE_CODE' => Yii::t('app', 'A unque code for the degree programme, e.g P15'),
            'DEGREE_NAME' => Yii::t('app', 'The actual name of the degree programme'),
            'DEGREE_TYPE' => Yii::t('app', 'A field for describing the degree type, either post graduate or undergraduate etc'),
            'DURATION' => Yii::t('app', 'Duration'),
            'UNIV_UNIVERISTY_CODE' => Yii::t('app', 'A unique code for the unversity, eg. UON'),
            'FACUL_FAC_CODE' => Yii::t('app', 'Facul  Fac  Code'),
            'CLUST_CLUSTER_NUMBER' => Yii::t('app', 'A unique number for the cluster'),
            'GRADINGSYSTEM' => Yii::t('app', 'Gradingsystem'),
            'DEGREE_URL' => Yii::t('app', 'Degree  Url'),
            'PROG_TYPE' => Yii::t('app', 'Prog  Type'),
            'FULL_NAME' => Yii::t('app', 'Full  Name'),
            'DEG_MODE' => Yii::t('app', 'Deg  Mode'),
            'COURSE_REG_TYPE' => Yii::t('app', 'Course  Reg  Type'),
            'PHYSICAL_LOCATION' => Yii::t('app', 'Physical  Location'),
            'BILLABLE' => Yii::t('app', 'Billable'),
            'DEG_PREFIX' => Yii::t('app', 'Deg  Prefix'),
            'DEGREE_STATUS' => Yii::t('app', 'Degree  Status'),
            'TRANSCRIPT_FACTOR' => Yii::t('app', 'Transcript  Factor'),
            'PASS_MARK' => Yii::t('app', 'Pass  Mark'),
            'BILLING_START_YEAR' => Yii::t('app', 'Billing  Start  Year'),
            'ANNUAL_SEMESTERS' => Yii::t('app', 'Annual  Semesters'),
            'MAX_UNITS' => Yii::t('app', 'Max  Units'),
            'ONLINE_SUPPORT' => Yii::t('app', 'Online  Support'),
            'AWARD_ROUNDING' => Yii::t('app', 'Award  Rounding'),
            'AVERAGE_TYPE' => Yii::t('app', 'Average  Type'),
            'BILLING_TYPE' => Yii::t('app', 'Billing  Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUNIVUNIVERISTYCODE()
    {
        return $this->hasOne(UNIVERSITIES::className(), ['UNIVERISTY_CODE' => 'UNIV_UNIVERISTY_CODE']);
    }
}

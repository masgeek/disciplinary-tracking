<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "UON_STUDENTS".
 *
 * @property string $INDEX_NUMBER
 * @property string $MARITAL_STATUS
 * @property string $OTHER_NAMES
 * @property string $RELIGION
 * @property string $REGISTRATION_NUMBER
 * @property string $ROOM__NUMBER
 * @property string $REMARKS
 * @property string $SEX
 * @property string $STUDENT_PHOTO
 * @property string $SURNAME
 * @property string $DEGREE_CODE
 * @property string $DATE_OF_REGISTRATION
 * @property string $DATE_OF_COMPLETION
 * @property integer $ENTRY_YEAR
 * @property string $SERIAL_NUMBER
 * @property integer $YEAR_OF_STUDY
 * @property string $METHOD_OF_STUDY
 * @property string $DIS_DISTRICT_CODE
 * @property string $RHALL_HALL_CODE
 * @property string $D_PROG_DEGREE_CODE
 * @property string $STC_STUDENT_CATEGORY_ID
 * @property string $CIT_COUNTRY_CODE
 * @property string $DIS_DISTRICT_CODE_RESIDES_IN
 * @property string $SSPONSOR_CODE
 * @property string $GRADUATION_YEAR
 * @property string $SDEPT_CODE
 * @property string $STAFF_STATUS
 * @property string $STUDENT_ADDRESS
 * @property string $ARCH_DATE
 * @property string $INTAKE_NAME
 * @property string $STUDENT_STATUS
 * @property string $SIGN
 * @property string $CURR_BALANCE
 * @property string $BIRTH_DATE
 * @property string $ACADEMIC_YEAR
 * @property string $NATIONAL_ID
 * @property string $USER_ID
 * @property string $LAST_UPDATE
 * @property string $EMAIL
 * @property string $STUDY_CENTRE
 * @property string $A_REASON
 * @property string $TELEPHONE
 * @property integer $KCSE_YEAR
 * @property string $CURRENCY_ID
 * @property integer $BIO_INFO
 *
 * @property STUDENTCATEGORIES $sTCSTUDENTCATEGORY
 */
class UONSTUDENTS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UON_STUDENTS';
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
            [['OTHER_NAMES', 'REGISTRATION_NUMBER', 'SEX', 'SURNAME', 'STC_STUDENT_CATEGORY_ID', 'CIT_COUNTRY_CODE', 'SSPONSOR_CODE'], 'required'],
            [['ENTRY_YEAR', 'YEAR_OF_STUDY', 'KCSE_YEAR', 'BIO_INFO'], 'integer'],
            [['CURR_BALANCE'], 'number'],
            [['INDEX_NUMBER', 'REGISTRATION_NUMBER', 'ROOM__NUMBER', 'ACADEMIC_YEAR'], 'string', 'max' => 20],
            [['MARITAL_STATUS', 'SERIAL_NUMBER', 'RHALL_HALL_CODE', 'STAFF_STATUS', 'STUDY_CENTRE'], 'string', 'max' => 10],
            [['OTHER_NAMES', 'EMAIL'], 'string', 'max' => 60],
            [['RELIGION', 'SURNAME', 'METHOD_OF_STUDY', 'NATIONAL_ID'], 'string', 'max' => 30],
            [['REMARKS', 'USER_ID'], 'string', 'max' => 50],
            [['SEX', 'DATE_OF_REGISTRATION', 'DATE_OF_COMPLETION', 'GRADUATION_YEAR', 'ARCH_DATE', 'BIRTH_DATE', 'LAST_UPDATE'], 'string', 'max' => 7],
            [['STUDENT_PHOTO', 'INTAKE_NAME', 'A_REASON', 'TELEPHONE'], 'string', 'max' => 100],
            [['DEGREE_CODE', 'DIS_DISTRICT_CODE', 'D_PROG_DEGREE_CODE', 'STC_STUDENT_CATEGORY_ID', 'CIT_COUNTRY_CODE', 'DIS_DISTRICT_CODE_RESIDES_IN', 'SSPONSOR_CODE', 'SDEPT_CODE'], 'string', 'max' => 5],
            [['STUDENT_ADDRESS'], 'string', 'max' => 200],
            [['STUDENT_STATUS'], 'string', 'max' => 15],
            [['SIGN'], 'string', 'max' => 40],
            [['CURRENCY_ID'], 'string', 'max' => 3],
            [['REGISTRATION_NUMBER'], 'unique'],
            [['STC_STUDENT_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => STUDENTCATEGORIES::className(), 'targetAttribute' => ['STC_STUDENT_CATEGORY_ID' => 'STUDENT_CATEGORY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INDEX_NUMBER' => Yii::t('app', 'K.C.S.E index number'),
            'MARITAL_STATUS' => Yii::t('app', 'Student\'s marital stutus'),
            'OTHER_NAMES' => Yii::t('app', 'Other names that the student uses'),
            'RELIGION' => Yii::t('app', 'Student\'s religion'),
            'REGISTRATION_NUMBER' => Yii::t('app', 'The student\'s registration number at the university'),
            'ROOM__NUMBER' => Yii::t('app', 'Student\'s room nuber in the halls'),
            'REMARKS' => Yii::t('app', 'Some remarks about the student'),
            'SEX' => Yii::t('app', 'Student\'s gender'),
            'STUDENT_PHOTO' => Yii::t('app', 'An pass port size photo of the  student'),
            'SURNAME' => Yii::t('app', 'Student\'s surname'),
            'DEGREE_CODE' => Yii::t('app', 'The code for the degree programme the student is enrolled for'),
            'DATE_OF_REGISTRATION' => Yii::t('app', 'The date the student registers for the a programme'),
            'DATE_OF_COMPLETION' => Yii::t('app', 'The date the student clears his/her course at the university'),
            'ENTRY_YEAR' => Yii::t('app', 'The calendar year the student joined the university'),
            'SERIAL_NUMBER' => Yii::t('app', 'A four digit number unique for every student in given year of  entry'),
            'YEAR_OF_STUDY' => Yii::t('app', 'The current year of study for a student'),
            'METHOD_OF_STUDY' => Yii::t('app', 'The method of study that applies only to Postgaduate students.  Eg. Thesis'),
            'DIS_DISTRICT_CODE' => Yii::t('app', 'A 3 digit code represting a district'),
            'RHALL_HALL_CODE' => Yii::t('app', 'The unique code for the hall'),
            'D_PROG_DEGREE_CODE' => Yii::t('app', 'A unque code for the degree programme, e.g P15'),
            'STC_STUDENT_CATEGORY_ID' => Yii::t('app', 'A unique code for each student category'),
            'CIT_COUNTRY_CODE' => Yii::t('app', 'Cit  Country  Code'),
            'DIS_DISTRICT_CODE_RESIDES_IN' => Yii::t('app', 'A 3 digit code represting a district'),
            'SSPONSOR_CODE' => Yii::t('app', 'Ssponsor  Code'),
            'GRADUATION_YEAR' => Yii::t('app', 'Graduation  Year'),
            'SDEPT_CODE' => Yii::t('app', 'Sdept  Code'),
            'STAFF_STATUS' => Yii::t('app', 'Staff  Status'),
            'STUDENT_ADDRESS' => Yii::t('app', 'Student  Address'),
            'ARCH_DATE' => Yii::t('app', 'Arch  Date'),
            'INTAKE_NAME' => Yii::t('app', 'Intake  Name'),
            'STUDENT_STATUS' => Yii::t('app', 'Student  Status'),
            'SIGN' => Yii::t('app', 'Sign'),
            'CURR_BALANCE' => Yii::t('app', 'Curr  Balance'),
            'BIRTH_DATE' => Yii::t('app', 'Birth  Date'),
            'ACADEMIC_YEAR' => Yii::t('app', 'Academic  Year'),
            'NATIONAL_ID' => Yii::t('app', 'National  ID'),
            'USER_ID' => Yii::t('app', 'User  ID'),
            'LAST_UPDATE' => Yii::t('app', 'Last  Update'),
            'EMAIL' => Yii::t('app', 'Email'),
            'STUDY_CENTRE' => Yii::t('app', 'Study  Centre'),
            'A_REASON' => Yii::t('app', 'A  Reason'),
            'TELEPHONE' => Yii::t('app', 'Telephone'),
            'KCSE_YEAR' => Yii::t('app', 'Kcse  Year'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'BIO_INFO' => Yii::t('app', 'Bio  Info'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTCSTUDENTCATEGORY()
    {
        return $this->hasOne(STUDENTCATEGORIES::className(), ['STUDENT_CATEGORY_ID' => 'STC_STUDENT_CATEGORY_ID']);
    }
}

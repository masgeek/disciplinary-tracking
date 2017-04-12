<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 12-Apr-17
 * Time: 10:26
 */

namespace app\modules\tracking\extended;


use app\modules\tracking\models\DEGREEPROGRAMMES;
use app\modules\tracking\models\FACULTIES;
use app\modules\tracking\models\STUDENTCATEGORIES;
use app\modules\tracking\models\STUDENTSSTATUS;
use app\modules\tracking\models\UONSTUDENTS;

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
 * @property STUDENTCATEGORIES $sTUDENTCATEGORY
 * @property DEGREEPROGRAMMES $dEGREEPROGRAMME
 * @property STUDENTSSTATUS $sTUDENTSTATUS
 */
class STUDENT_MODEL extends UONSTUDENTS
{
    /*
    $scenarios = parent::scenarios();
    $scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];
    $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
    return $scenarios;*/

    /**
     * @inheritdoc
     */
    /*
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['D_PROG_DEGREE_CODE'], 'exist', 'skipOnError' => true, 'targetClass' => DEGREEPROGRAMMES::className(), 'targetAttribute' => ['D_PROG_DEGREE_CODE' => 'DEGREE_CODE']];
        return $rules;
    }
*/

    public function getSTUDENTCATEGORY()
    {
        return $this->hasOne(STUDENTCATEGORIES::className(), ['STUDENT_CATEGORY_ID' => 'STC_STUDENT_CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEGREEPROGRAMME()
    {
        return $this->hasOne(DEGREEPROGRAMMES::className(), ['DEGREE_CODE' => 'D_PROG_DEGREE_CODE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTUDENTSTATUS()
    {
        return $this->hasOne(STUDENTSSTATUS::className(), ['STATUS_CODE' => 'STUDENT_STATUS']);
    }
}
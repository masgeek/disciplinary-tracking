<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/11/2017
 * Time: 18:16
 */

namespace app\modules\reporting\models;


use app\components\CONSTANTS;
use app\modules\tracking\extended\STUDENT_MODEL;
use app\modules\tracking\models\CASEINCIDENCES;
use app\modules\tracking\models\COLLEGES;
use app\modules\tracking\models\FACULTIES;
use app\modules\tracking\models\STUDENTSSTATUS;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * Class INCIDENCE_MODEL
 * @property FACULTIES $fACULTY
 * @property COLLEGES $COLLEGE
 * @package app\modules\reporting\models
 */
class CASE_INCIDENCE_MODEL extends CASEINCIDENCES
{
    /**
     * @inheritdoc
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[CONSTANTS::SCENARIO_SEARCH] = [
            'INCIDENCE_ID',
            'STUDENT_REG_NO',
            'CASE_DESCRIPTION',
            'STATUS_CODE',
            'REPORTED_BY',
            'DATE_REPORTED',
            'DATE_ADDED',
            'FACULTY_CODE',
            'COLLEGE_CODE',
        ];//Scenario Values Only Accepted
        $scenarios[CONSTANTS::SCENARIO_INSERT] = [
            'INCIDENCE_ID',
            'STUDENT_REG_NO',
            'CASE_DESCRIPTION',
            'STATUS_CODE',
            'REPORTED_BY',
            'DATE_REPORTED',
            'DATE_ADDED',
            'FACULTY_CODE',
            'COLLEGE_CODE',
        ];//Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENT_REG_NO', 'CASE_DESCRIPTION', 'STATUS_CODE', 'REPORTED_BY', 'DATE_REPORTED', 'FACULTY_CODE', 'COLLEGE_CODE'], 'required', 'on' => CONSTANTS::SCENARIO_INSERT],
            [['INCIDENCE_ID'], 'integer'],
            [['DATE_REPORTED', 'DATE_ADDED'], 'safe'],
            [['STUDENT_REG_NO', 'REPORTED_BY', 'FACULTY_CODE'], 'string', 'max' => 20],
            [['CASE_DESCRIPTION'], 'string', 'max' => 500],
            [['STATUS_CODE'], 'string', 'max' => 8],
            [['INCIDENCE_ID'], 'unique'],
            [['STATUS_CODE'], 'exist', 'skipOnError' => true, 'targetClass' => STUDENTSSTATUS::className(), 'targetAttribute' => ['STATUS_CODE' => 'STATUS_CODE']],
        ];
    }


    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_ADDED = $date;
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STATUS_CODE' => \Yii::t('app', \Yii::t('app', 'Student Status')),
            'FACULTY_CODE' => \Yii::t('app', \Yii::t('app', 'Faculty Name')),
            'COLLEGE_CODE' => \Yii::t('app', \Yii::t('app', 'College Name')),
        ];
    }

    /**
     * @return array
     */
    public static function GetStudentsList()
    {
        $list = STUDENT_MODEL::find()
            ->select(['REGISTRATION_NUMBER', 'CONCAT(REGISTRATION_NUMBER,CONCAT(\' \', CONCAT(SURNAME,CONCAT(\' \',OTHER_NAMES)))) AS NAMES'])
            ->where('STUDENT_STATUS IS NOT NULL')
            ->asArray()
            ->limit(50)
            ->orderBy(['REGISTRATION_NUMBER' => SORT_DESC])
            ->all();
        $students_list = ArrayHelper::map($list, 'REGISTRATION_NUMBER', 'NAMES');
        return $students_list;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFACULTY()
    {
        return $this->hasOne(FACULTIES::className(), ['FAC_CODE' => 'FACULTY_CODE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     * @deprecated We do not really need this the faculty code can be used to get the college code
     */
    public function getCOLLEGE()
    {
        return $this->hasOne(FACULTIES::className(), ['COL_CODE' => 'COLLEGE_CODE']);
    }


    /**
     * @param $params
     * @param null $college_code
     * @param null $faculty_code
     * @return ActiveDataProvider
     */
    public function GetPendingCases($params, $college_code = null, $faculty_code = null)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'INCIDENCE_ID' => SORT_DESC
                ]
            ]
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        if ($college_code != null) {
            $query->andFilterWhere(['COLLEGE_CODE' => $college_code]);
        } else {
            $query->andFilterWhere(['COLLEGE_CODE' => $this->COLLEGE_CODE]);
        }

        if ($faculty_code != null) {
            $query->andFilterWhere(['FACULTY_CODE' => $faculty_code]);
        } else {
            $query->andFilterWhere(['FACULTY_CODE' => $this->FACULTY_CODE]);
        }

        //$query->andFilterWhere(['ip' => $this->ip]);
        //$query->andFilterWhere(['like', 'created', $this->created]);
        //$query->with(['linkedErrors', 'javascripts']);

        return $dataProvider;
    }
}
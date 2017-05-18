<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/20/2017
 * Time: 12:32 PM
 */

namespace app\modules\reporting\models;


use app\components\CONSTANTS;
use app\modules\tracking\models\PROCESS;
use app\modules\tracking\models\TRACKING;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/* @property CASE_INCIDENCE_MODEL $iNCIDENCE */
class TRACKING_MODEL extends TRACKING
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INCIDENCE_ID', 'PROCESS_ID', 'TRACKING_STATUS', 'ADDED_BY', 'ACTED_ON_BY', 'COMMENTS'], 'required'],
            [['TRACKING_ID', 'INCIDENCE_ID', 'PROCESS_ID', 'TRACKING_STATUS'], 'integer'],
            [['DATE_RECEIVED', 'DATE_UPDATED'], 'safe'],
            [['COMMENTS'], 'string', 'max' => 500],
            [['ADDED_BY', 'ACTED_ON_BY'], 'string', 'max' => 20],
            [['TRACKING_ID'], 'unique'],
            [['INCIDENCE_ID', 'PROCESS_ID'], 'unique', 'targetAttribute' => ['INCIDENCE_ID', 'PROCESS_ID'], 'message' => 'The combination of Incidence  ID and Process  ID has already been taken.'],
            [['PROCESS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PROCESS::className(), 'targetAttribute' => ['PROCESS_ID' => 'PROCESS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INCIDENCE_ID' => \Yii::t('app', 'Incidence Name'),
            'PROCESS_ID' => \Yii::t('app', 'Process Name'),
        ];
    }

    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_RECEIVED = $date;
                //$this->TRACKING_STATUS = CONSTANTS::STATUS_COMPLETE;
            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINCIDENCE()
    {
        return $this->hasOne(CASE_INCIDENCE_MODEL::className(), ['INCIDENCE_ID' => 'INCIDENCE_ID']);
    }

    /**
     * Get the first process for first submission
     * @param integer $incidence_id
     * @param integer $tracking_status
     * @return array
     */
    public static function GetTrackedProcesses($incidence_id, $tracking_status = CONSTANTS::STATUS_COMPLETE)
    {

        $incidence_array = self::find()->select('PROCESS_ID')
            ->where(['INCIDENCE_ID' => $incidence_id])
            //->andWhere(['TRACKING_STATUS' => $tracking_status])
            //->orderBy(['ORDER_NO' => SORT_ASC])
            ->asArray()
            ->all();
        return $incidence_array;
    }

    public function search($incidence_id)
    {
        $query = self::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['INCIDENCE_ID' => $incidence_id]);
        return $dataProvider;
    }
}
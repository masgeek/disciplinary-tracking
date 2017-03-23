<?php

namespace app\modules\setup\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\setup\models\PROCESS_MODEL;

/**
 * Processsearch represents the model behind the search form about `app\modules\setup\models\PROCESS_MODEL`.
 */
class Processsearch extends PROCESS_MODEL
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROCESS_ID', 'CASE_TYPE_ID', 'ORDER_NO'], 'integer'],
            [['PROCESS_NAME', 'DESCRIPTION', 'DATE_ADDED', 'DATE_MODIFIED'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PROCESS_MODEL::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'PROCESS_ID' => $this->PROCESS_ID,
            'CASE_TYPE_ID' => $this->CASE_TYPE_ID,
            'ORDER_NO' => $this->ORDER_NO,
            'DATE_ADDED' => $this->DATE_ADDED,
            'DATE_MODIFIED' => $this->DATE_MODIFIED,
        ]);

        $query->andFilterWhere(['like', 'PROCESS_NAME', $this->PROCESS_NAME])
            ->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION]);

        return $dataProvider;
    }
}

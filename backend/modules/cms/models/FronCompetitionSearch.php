<?php

namespace backend\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cms\models\FronCompetition;

/**
 * FronCompetitionSearch represents the model behind the search form about `backend\modules\cms\models\FronCompetition`.
 */
class FronCompetitionSearch extends FronCompetition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'status'], 'integer'],
            [['str_time', 'end_time'], 'safe'],
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
        $query = FronCompetition::find();

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
            'aid' => $this->aid,
            'status' => $this->status,
        ]);

        if ($this->str_time) {
            $query->andFilterWhere(['>', 'str_time', strtotime($this->str_time)]);
        }

        if ($this->end_time) {
            $query->andFilterWhere(['<', 'end_time', strtotime($this->end_time)]);
        }

        return $dataProvider;
    }
}

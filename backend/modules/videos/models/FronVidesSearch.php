<?php

namespace backend\modules\videos\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\videos\models\FronVideos;

/**
 * FronVidesSearch represents the model behind the search form about `backend\modules\videos\models\FronVideos`.
 */
class FronVidesSearch extends FronVideos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rec'], 'integer'],
            [['path', 'title', 'desc', 'created_at'], 'safe'],
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
        $query = FronVideos::find();

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
            'id' => $this->id,
            'fid' => $this->fid,
            'rec' => $this->rec,
          //  'clicked' => $this->clicked,
        ]);

        if($this->created_at){
            $query->andFilterWhere(['>', 'created_at', strtotime($this->created_at)]);
        }

        $query->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}

<?php

namespace backend\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FronArticleSearch represents the model behind the search form about `backend\modules\cms\models\FronArticle`.
 */
class CompetitionAssortResultSearch extends CompetitionAssortResult
{

    public $aid;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tid', 'title'], 'integer'],
            [['created_at', 'updated_at'], 'string'],
            [['id', 'tid', 'title'], 'safe'],
        ];
    }

    public function __construct($aid, $config = [])
    {
        $this->aid  = $aid;
        parent::__construct($config);
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
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CompetitionAssortResult::find()
                 ->joinWith(['tags'])
                 ->where('fron_competition_assort_tags.aid = :aid',[':aid' => $this->aid]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tid' => $this->tid,
        ]);

        if ($this->created_at) {
            $query->andFilterWhere(['>', 'created_at', strtotime($this->created_at)]);
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}

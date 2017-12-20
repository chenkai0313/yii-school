<?php

namespace backend\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cms\models\FronArticle;
use yii\helpers\ArrayHelper;

/**
 * FronArticleSearch represents the model behind the search form about `backend\modules\cms\models\FronArticle`.
 */
class CompetitionResultSearch extends CompetitionResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'fid', 'top', 'rec', 'clicked'], 'integer'],
            [['created_at', 'updated_at'], 'string'],
            [['title', 'desc', 'author', 'source', 'content'], 'safe'],
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
        $query = CompetitionResult::find()->where([
            'in',
            'cid',
            ArrayHelper::getColumn(CompetitionResult::getChildrenCategory()->asArray()->all(),'id')
        ]);

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
            'cid' => $this->cid,
            'fid' => $this->fid,
            'top' => $this->top,
            'rec' => $this->rec,
            'clicked' => $this->clicked,
        ]);

        if($this->created_at) {
            $query->andFilterWhere(['>', 'created_at', strtotime($this->created_at)]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}

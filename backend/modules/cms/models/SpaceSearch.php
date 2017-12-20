<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

use yii\data\ActiveDataProvider;

class SpaceSearch extends Space
{
    public function rules()
    {
        return [
            [['title','author'], 'string'],
            [['id','cid'], 'integer'],
            [['created_at','rec', 'top'], 'safe'],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Space::find()->where(['in','cid', $this->getChildCategory()]);

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
             'id' => $this->id,
             'top' => $this->top,
             'rec' => $this->rec,
             'cid' => $this->cid,
        ]);

        if($this->created_at){
            $query->andFilterWhere(['>','created_at', strtotime($this->created_at)]);
        }


        $query->andFilterWhere(['like', 'author', $this->author]);
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
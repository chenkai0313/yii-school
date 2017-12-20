<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

use yii\data\ActiveDataProvider;

class NoticeSearch extends Notice
{
    public function rules()
    {
        return [
            [['title','author'], 'string'],
            [['id','clicked'], 'integer'],
            [['created_at','top','rec'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Notice::find()->where(['cid' => Notice::$cid]);

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
             'id' => $this->id,
             'clicked' => $this->clicked,
        ]);

        if($this->created_at){
            $query->andFilterWhere(['>','created_at', strtotime($this->created_at)]);
        }

        $query->andFilterWhere(['like', 'author', $this->author]);
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
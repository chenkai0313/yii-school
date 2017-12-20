<?php

/**
 * Created by getpu on 16/9/7.
 */

namespace backend\modules\cms\models;

use yii\data\ActiveDataProvider;

class TeacherSearch extends Teacher
{
    public function rules()
    {
        return [
            [['title','author','tag'], 'string'],
            [['id','clicked'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Teacher::find()->where(['cid' => Teacher::$cid]);

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
        $query->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}
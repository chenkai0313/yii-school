<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

use yii\data\ActiveDataProvider;

class InvestmentSearch extends Investment
{
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['fid'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Investment::find()->where(['cid' => Investment::$cid]);

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
             'id' => $this->id,
        ]);

        if($this->created_at){
            $query->andFilterWhere(['>','created_at', strtotime($this->created_at)]);
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
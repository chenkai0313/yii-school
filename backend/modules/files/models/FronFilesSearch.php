<?php

/**
 * Created by getpu on 16/8/26.
 */
 
namespace backend\modules\files\models;


use yii\data\ActiveDataProvider;

class FronFileSearch extends FronFiles
{
    public function rules()
    {
        return [
            [['id','tid','created_at','updated_at'],'integer'],
            [['host','name','extension'],'safe'],
        ];
    }

    public function scenarios()
    {
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = FronFiles::find();

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tid' => $this->tid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like','name',$this->name]);

        return $dataProvider;
    }


}
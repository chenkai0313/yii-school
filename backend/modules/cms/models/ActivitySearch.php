<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity
{
    public function rules()
    {
        return [
            [['title','author'], 'string'],
            [['id','cid'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Activity::find()->where(['in','cid', $this->getChildCategory()]);

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
             'id' => $this->id,
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
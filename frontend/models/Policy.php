<?php

/**
 * Created by getpu on 16/9/8.
 * 政策信息 政策公告
 */

namespace frontend\models;

use yii\data\ActiveDataProvider;

class Policy extends \backend\modules\cms\models\Policy
{
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['title'], 'safe'],
        ];
    }

    public function getData($params)
    {
        $query = Policy::find()->where(['cid' => Policy::$cid]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 17,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        \Yii::trace($this->title);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
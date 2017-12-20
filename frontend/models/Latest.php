<?php

/**
 * Created by getpu on 16/9/12.
 * 创业干货 最新文章
 */
 
namespace frontend\models;



use yii\data\ActiveDataProvider;

class Latest extends \backend\modules\cms\models\NewArticle
{

    /*
    public function rules()
    {
        return [
        ];
    }
    */


    public function getData($params)
    {
        $query = Latest::find()->where(['cid' => Latest::$cid]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
              'pageSize' => 6,
            ],
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        return $dataProvider;
    }
}
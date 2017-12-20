<?php

/**
 * Created by getpu on 16/9/12.
 * 在线课程
 */
 
namespace frontend\models;

use yii\data\ActiveDataProvider;

class Videos extends \backend\modules\videos\models\FronVideos
{
    const CREATED_AT = 1;
    const CLICKED  = 2;
    const REC = 3;

    public $s; //排序
    public $q; //搜索

    public function rules()
    {
        return [
            [['s'], 'integer'],
            [['q'], 'string'],
        ];
    }

    public function search($params)
    {

        $query = Videos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->filterWhere(['like', 'title', $this->q]);

        if($this->s == 1){
            $query->addOrderBy(['created_at' => SORT_DESC]);
        }else if($this->s == 2){
            $query->addOrderBy(['clicked' => SORT_DESC]);
        }else if($this->s == 3){
            $query->addOrderBy(['rec' => SORT_DESC]);
        }



        return $dataProvider;
    }

}
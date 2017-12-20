<?php

/**
 * Created by getpu on 16/9/2.
 * 转载文章
 */
 
namespace frontend\models;
use yii\data\ActiveDataProvider;
use frontend\models\Reprint;

use frontend\models\Article;

use yii\web\Controller;
use frontend\models\News;
use yii\data\Pagination;


class Reprint extends \backend\modules\cms\models\FronReprint
{
	public function getData()
    {

  // $reprints = Reprint::find()->orderBy(['created_at' => SORT_ASC])->limit(10)->all();
   
        $query = Reprint::find();
    

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 17,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_ASC,
                ],
            ],
        ]);

        return $dataProvider;
    }

}
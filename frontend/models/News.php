<?php

/**
 * Created by getpu on 16/8/31.
 * 动态信息 新闻动态
 */
 
namespace frontend\models;

use yii\data\ActiveDataProvider;

class News extends Article
{
    public static $cid = 4;

    public static function getData()
    {
        return new ActiveDataProvider([
            'query' => News::find()->where(['cid' => self::$cid]),
            'pagination' => [
               'pageSize' => 3,
            ],
        ]);
    }
}
<?php

/**
 * Created by getpu on 16/8/31.
 */
 
namespace frontend\models;


class Dynamic extends Article
{
    public static $parent_id = 3;


    public static function getNews()
    {
        return self::find()->where(['cid' => 4])->orderBy(['top' => SORT_ASC, 'rec' => SORT_ASC])->limit(9)->all();
    }

}
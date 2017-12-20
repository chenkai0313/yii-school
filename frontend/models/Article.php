<?php

/**
 * Created by getpu on 16/8/31.
 */
 
namespace frontend\models;

use yii\helpers\ArrayHelper;

class Article extends \backend\modules\cms\models\FronArticle
{

    public static $parent_id;

    /**
     * @param $parent_id
     * @return array
     */
    public static function getCategoryChildren($parent_id)
    {
        $children =  Category::findOne($parent_id)->children()->all();
        if($children){
            return ArrayHelper::map((ArrayHelper::toArray($children)),'id','id');
        }
    }

}
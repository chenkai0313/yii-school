<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

use yii\helpers\ArrayHelper;

class Space extends FronArticle
{
    public static $cid = 15;

    public function init()
    {
        //$this->cid = self::$cid;
        parent::init();
    }

    protected function getChildCategory()
    {
        return ArrayHelper::getColumn(FronCategory::findOne(Space::$cid)->children(1)->asArray()->all(),'id');
    }
}
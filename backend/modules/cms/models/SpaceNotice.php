<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

use yii\helpers\ArrayHelper;

class SpaceNotice extends Space
{

    public function getCategoryName()
    {
        return FronCategory::findOne($this->getParentCategory()[0]);
    }

    public function getChildCategory()
    {
        return ArrayHelper::getColumn(FronCategory::findOne(Space::$cid)->children(2)->asArray()->all(),'id');
    }

    public function getParentCategory()
    {
        return ArrayHelper::getColumn(FronCategory::findOne($this->cid)->parents(1)->asArray()->all(),'id');
    }

}
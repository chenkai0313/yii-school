<?php

/**
 * Created by getpu on 16/9/23.
 * 创业空间 最新公告
 */
 
namespace frontend\models;

use yii\helpers\ArrayHelper;


class SpaceNotice extends \backend\modules\cms\models\SpaceNotice
{
    /**
     * @return array
     */
    public function getChildCategory($cid)
    {
        if(!isset($cid)){
            $cid = $this->cid;
        }
        return ArrayHelper::getColumn(Category::findOne($cid)->children()->asArray()->all(),'id');
    }
}
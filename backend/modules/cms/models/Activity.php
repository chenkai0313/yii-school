<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

use yii\helpers\ArrayHelper;

class Activity extends FronArticle
{
    public static $cid = 27;

    public function init()
    {
        //$this->cid = self::$cid;
        parent::init();
    }

    protected function getChildCategory()
    {
        return ArrayHelper::getColumn(FronCategory::findOne(Activity::$cid)->children(1)->asArray()->all(),'id');
    }

    public function getExten()
    {
        return $this->hasOne(ActivityExtension::className(),['aid' => 'id']);
    }

    public function getJoin()
    {
        return $this->hasOne(FronCompetitionJoin::className(), ['aid' => 'id']);
    }

}
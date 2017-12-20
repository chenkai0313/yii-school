<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

use Yii;

class Investment extends FronArticle
{
    public static $cid = 41;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['title'] = Yii::t('app', 'Investment Name');
        $labels['fid']   = Yii::t('app', 'Investment Image');
        return $labels;
    }

}
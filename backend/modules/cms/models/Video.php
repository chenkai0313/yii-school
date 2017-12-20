<?php

/**
 * Created by getpu on 16/9/9.
 */

namespace backend\modules\cms\models;

use Yii;

class Video extends FronArticle
{
    public static $cid = 14;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['fid'] = Yii::t('app','Video file');
        $labels['author'] = Yii::t('app','Video Author');
        $labels['clicked'] = Yii::t('app','Video Clicked');
        return $labels;
    }
}
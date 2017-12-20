<?php

/**
 * Created by getpu on 16/9/6.
 * 合作媒体
 */

namespace backend\modules\cms\models;

use Yii;

class AssociatedMedia extends FronArticle
{
    public static $cid = 28;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }
    
}
<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

use Yii;

class CompetitionAssort extends FronArticle
{
    public static $cid = 54;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }
    
}
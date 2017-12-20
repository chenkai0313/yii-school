<?php

/**
 * Created by getpu on 16/9/7.
 */

namespace backend\modules\cms\models;

class Policy extends FronArticle
{
    public static $cid = 10;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }
}
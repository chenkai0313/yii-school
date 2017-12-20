<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

class Research extends FronArticle
{
    public static $cid = 49;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

}
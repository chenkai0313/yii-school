<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

class EntrepreneurialPioneer extends FronArticle
{
    public static $cid = 20;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

}
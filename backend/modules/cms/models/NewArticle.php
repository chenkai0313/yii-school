<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

class NewArticle extends FronArticle
{
    public static $cid = 13;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

}
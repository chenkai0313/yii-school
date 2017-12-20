<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

class EntrepreneurialSocial extends FronArticle
{
    public static $cid = 22;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

}
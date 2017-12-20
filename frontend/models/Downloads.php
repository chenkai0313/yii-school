<?php

/**
 * Created by getpu on 16/9/20.
 */
 
namespace frontend\models;

class Downloads extends \backend\modules\files\models\FronDownloads
{
    public static function getLayout($cid,$limit = 6)
    {
        return Downloads::find()
               ->where('cid = :cid', [':cid' => $cid ])
               ->orderBy(['updated_at' => SORT_DESC])
               ->limit($limit)
               ->all();
    }
}
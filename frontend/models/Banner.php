<?php

/**
 * Created by getpu on 16/8/29.
 */
 
namespace frontend\models;

class Banner extends \backend\modules\navbar\models\FronBanner
{

    /**
     * @param $tid integer
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getBanner($tid)
    {
        return self::find()
            ->where('tid = :tid',[':tid' => $tid])
            ->orderBy(['sort' => SORT_DESC])
            ->all();
    }
}
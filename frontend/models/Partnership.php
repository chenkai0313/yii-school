<?php

/**
 * Created by getpu on 16/9/19.
 * 合作伙伴
 */

namespace frontend\models;

class Partnership extends \backend\modules\cms\models\Partnership
{
    /**
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getLayout($limit = 3)
    {
        return Partnership::find()
               ->where(['cid' => Partnership::$cid])
               ->limit($limit)
               ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
               ->all();
    }
}

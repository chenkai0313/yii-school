<?php

/**
 * Created by getpu on 16/9/19.
 * 最新公告
 */

namespace frontend\models;

use yii\data\ActiveDataProvider;

class Notice extends \backend\modules\cms\models\Notice
{
    /**
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getLayout($limit = 3)
    {
        return Notice::find()
            ->where(['cid' => Notice::$cid])
            ->limit($limit)
            ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->all();
    }

    // public function getData()
    // {
    //     return new ActiveDataProvider([
    //         'query' => self::find()->where(['cid' => self::$cid])
    //     ]);
    // }


    public function getData()
    {
        $query = self::find()->where(['cid' => self::$cid]);
  

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 17,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        return $dataProvider;
    }
}
 

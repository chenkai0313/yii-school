<?php

/**
 * Created by getpu on 16/9/21.
 */
 
namespace frontend\models;

class Activity extends \backend\modules\cms\models\Activity
{
    /**
     * @return object
     */
    public function getArticle()
    {
        return $this->hasOne(Activity::className(),['cid' => 'cid'])->alias('c')->where(['in','c.cid', $this->getChildCategory()]);
    }

    /**
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getData($limit = 5)
    {
        $query = self::find()
                 ->alias('m')
                 ->joinWith(['article'])
                 ->andWhere('`m`.`updated_at` <= `c`.`updated_at`')
                 ->groupBy(['m.id','m.cid'])
                 ->having('count(`c`.`id`) <= :limit')
                 ->addParams([':limit' => $limit])
                 ->orderBy(['m.cid' => SORT_DESC])
                 ->all();
        return $query;
    }

    /**
     * @param $cid
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getItems($cid, $limit = 5)
    {
        $query = self::find()
                 ->where('cid = :cid',[':cid' => $cid])
                 ->orderBy(['updated_at' => SORT_DESC])
                 ->limit($limit)
                 ->all();
        return $query;
    }

    /**
     * @return array
     */
    public function getChildCategory()
    {
       return parent::getChildCategory();
    }

}
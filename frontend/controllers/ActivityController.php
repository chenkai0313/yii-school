<?php

/**
 * Created by getpu on 16/9/18.
 * 创业空间
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Category;
use frontend\models\Activity;
use frontend\models\News;
use frontend\models\Article;



class ActivityController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new Activity;
        $cates = $model->getChildCategory();
        $top   = $model::find()
                 ->where(['in','cid', $cates])
                 ->andWhere(['top' => 1])
                 ->orderBy(['updated_at' => SORT_DESC])
                 ->limit(6)
                 ->all();

        $categorys = Category::find()
                     ->where(['in','id', $cates])
                     ->all();

        return $this->render('index', [
            'top' => $top, //顶置
            'categorys' => $categorys, //分類
            'limit' => 15, //每個分類顯示多少條
        ]);
    }

    public function actionDetail($cid,$id)
    {
        $detail = Activity::find()->where('cid = :cid and id = :id',[':cid' => $cid, ':id' => $id])->one();
        $rec = Article::find()->where('cid = :cid and rec = :rec',[':cid' => $cid,':rec' => 1])->orderBy(['updated_at' => SORT_ASC])->limit(20)->all();
        if($detail !== null){
            $detail->updateCounters(['clicked' => 1]);
        }
        return $this->render('detail',[
            'detail' => $detail,
            'rec' => $rec,
        ]);
    }
}


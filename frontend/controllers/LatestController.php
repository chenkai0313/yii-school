<?php

/**
 * Created by getpu on 16/9/12.
 */
 
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Latest;
use frontend\models\AssociatedMedia;

class LatestController extends Controller
{
    public function actionIndex()
    {
        $model = new Latest;
        $top   = $model::find()
            ->where(['cid' => Latest::$cid])
            ->orderBy(['top' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->limit(3)
            ->all();

        $rec = AssociatedMedia::find()
            ->where(['cid' => AssociatedMedia::$cid])
            ->orderBy(['rec' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->limit(5)
            ->all();

        $dataProvider = $model->getData(Yii::$app->request->queryParams);

        return $this->render('index', [
            'top' => $top,      // 顶置
            'rec' => $rec,      // 推荐
            'dataProvider' => $dataProvider,
        ]);
    }
}
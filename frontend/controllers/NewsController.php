<?php

/**
 * Created by getpu on 16/8/31.
 */

namespace frontend\controllers;

use frontend\models\Article;
use frontend\models\Reprint;
use yii\web\Controller;
use frontend\models\News;
use yii\data\Pagination;

class NewsController extends Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        $dataProvider = News::getData();
        // 1条顶置
        $top = News::find()->where(['top' => 1])->orderBy(['updated_at' => SORT_DESC])->one();
        // 3条推荐
        $rec = News::find()->where(['rec' => 1])->orderBy(['updated_at' => SORT_DESC])->limit(3)->all();

        $reprints = Reprint::find()->orderBy(['created_at' => SORT_ASC])->limit(10)->all();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'reprints' => $reprints,
                    'top' => $top,
                    'rec' => $rec,
        ]);
    }

    public function actionList(){


        $model = new Reprint;

        return $this->render('list',[
            'dataProvider' => $model->getData(),
        ]);
        // $reprints = Reprint::find()->orderBy(['created_at' => SORT_ASC])->all();
        // $query = Reprint::find()->orderBy(['created_at' => SORT_ASC])->all(); 
        // return $this->render('list',[

        //     'query' => $query,
        //     'pagination' => [
        //         'pageSize' => 17,
        //     ],
        //     'sort' => [
        //         'defaultOrder' => [
        //             'created_at' => SORT_DESC,
        //         ],
        //     ],

        //     'dataProvider' => $reprints,
        //     ]);
    }


    /**
     * @param $cid
     * @param $id
     * @return string
     */
    public function actionDetail($cid, $id) {
        $detail = News::find()->where('cid = :cid and id = :id', [':cid' => $cid, ':id' => $id])->one();
        $rec = Article::find()->where('cid = :cid and rec = :rec', [':cid' => $cid, ':rec' => 1])->orderBy(['updated_at' => SORT_ASC])->limit(20)->all();
        if ($detail !== null) {
            $detail->updateCounters(['clicked' => 1]);
        }
        return $this->render('detail', [
                    'detail' => $detail,
                    'rec' => $rec,
        ]);
    }

    /*     * *
     * @return string
     */

    public function actionLayout() {
        $dataProvider = News::find()->where(['cid' => 4])->limit(9)->all();

        return $this->render('layout', [
                    'dataProvider' => $dataProvider,
        ]);
    }

}

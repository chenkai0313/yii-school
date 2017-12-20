<?php

namespace mobile\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use mobile\models\FronArticle;

/**
 * Site controller
 */
class IntroController extends Controller {

    public function actionDetail() {

        $this->layout = false;
        $this->getView()->title = "学院介绍";
        //推荐阅读
        $recommend = FronArticle::find()
                ->joinWith('fronFiles')
                ->joinWith('fronCategorys')
                ->where(['{{%fron_article}}.rec' => 1])
                ->limit(2)
                ->all();


        return $this->render('detail', ['recommend' => $recommend]);
    }

    public function actionIndex() {
        $this->layout = false;
        $this->getView()->title = "机构设置";
        //推荐阅读
        $recommend = FronArticle::find()
                ->joinWith('fronFiles')
                ->joinWith('fronCategorys')
                ->where(['{{%fron_article}}.rec' => 1])
                ->limit(2)
                ->all();
        return $this->render('index', ['recommend' => $recommend]);
    }

}

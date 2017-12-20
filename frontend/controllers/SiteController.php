<?php

namespace frontend\controllers;

use frontend\models\Videos;
use Yii;
use yii\web\Controller;
use frontend\models\Banner;
use frontend\models\Dynamic;
use frontend\models\Social;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $banner = Banner::find()->where(['tid' => 13])->orderBy(['sort' => SORT_ASC])->all(); // 首页横幅
        $dynamic = Dynamic::getNews();
        foreach ($dynamic as &$v1) {
        $title = $v1['title'];
        $v1['title'] = mb_strlen($title, 'utf-8') > 14 ? mb_substr($title, 0, 14, 'utf-8') . '...' : $title;
        $content = $v1['desc'];
          $v1['desc'] = mb_strlen($content, 'utf-8') > 35 ? mb_substr($content, 0, 35, 'utf-8') . '...' : $content;
        }
        $videos = Videos::find()->orderBy(['created_at' => SORT_DESC])->limit(2)->all();
        $social = Social::find()->where(['cid' => Social::$cid])->limit(16)->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC])->all();



        return $this->render('index', [
                    'banner' => $banner,
                    'dynamic' => $dynamic, //动态信息
                    'videos' => $videos, //在线课程
                    'social' => $social, //创业团队
        ]);
    }

}

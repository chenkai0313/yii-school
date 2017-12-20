<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Banner;
use frontend\models\Pioneer;
use frontend\models\Recruit;
use frontend\models\Social;

class EntrepreneurialController extends Controller
{
    public function actionIndex()
    {
        $banner = Banner::find()->where(['tid' => 17])->orderBy(['sort' => SORT_DESC])->all(); // 首页横幅
        $pioneer = Pioneer::find()->where(['cid' => Pioneer::$cid])->limit(20)->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC])->all();
        $recruit = Recruit::find()->where(['cid' => Recruit::$cid])->limit(20)->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC])->all();
        $social  = Social::find()->where(['cid' => Social::$cid])->limit(8)->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC])->all();
        return $this->render('index', [
            'banner' => $banner,
            'pioneer' => $pioneer,
            'recruit' => $recruit,
            'social'  => $social,
        ]);
    }
}
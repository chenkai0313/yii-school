<?php

/**
 * Created by getpu on 16/8/23.
 */
 
namespace backend\modules\setting\controllers;

use Yii;
use yii\helpers\Url;
use backend\modules\setting\models\Website;
use backend\modules\setting\models\Mobilesite;
use backend\modules\setting\models\Qiniusite;

class WebsiteController extends \getpu\user\controllers\AccessController
{

    /**
     * @return string
     * @meta [系统设置] 网站信息
     */
    public function actionIndex()
    {
        $model = new Website;
        if($model->load(Yii::$app->request->post()) && $model->saveAll()){
            Yii::$app->getSession()->setFlash('success',Yii::t('app','Your website success updated'));
            return $this->refresh();
        }

        return $this->render('index',[
            'model' => $model
        ]);
    }

    /**
     * @return string
     * @meta [系统设置] 手机信息
     */
    public function actionMobile()
    {
        $model = new Mobilesite;
        if($model->load(Yii::$app->request->post()) && $model->saveAll()){
            Yii::$app->getSession()->setFlash('success',Yii::t('app','Your website success updated'));
            return $this->refresh();
        }

        return $this->render('mobile',[
            'model' => $model,
        ]);
    }

    /**
     * @return string
     * @meta [系统设置] 七牛设置
     */
    public function actionQiniu()
    {
        $model = new Qiniusite;
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->saveAll()){
            Yii::$app->getSession()->setFlash('success',Yii::t('app','Your qiniu information success updated'));
            return $this->refresh();
        }

        return $this->render('qiniu',[
            'model' => $model,
        ]);
    }

}
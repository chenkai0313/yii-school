<?php

/**
 * Created by getpu on 16/9/1.
 */
 
namespace backend\modules\setting\controllers;

use backend\modules\setting\models\Cached;

class CachedController extends \getpu\user\controllers\AccessController
{
    /**
     * @return string
     * @meta [系统设置] 缓存管理
     */
    public function actionIndex()
    {
        $model = new Cached;

        return $this->render('index',[
            'model' => $model,
        ]);
    }

    /**
     * @param $key
     * @return mixed
     * @meta [系统设置] 删除缓存
     */
    public function actionDelete($key)
    {
        $model = new Cached;
        if($model->delete($key)){
          \Yii::$app->session->setFlash('success',\Yii::t('app',"{key} cache has been deleted",['key' => $key]));
        }
        return $this->redirect('index');
    }
}

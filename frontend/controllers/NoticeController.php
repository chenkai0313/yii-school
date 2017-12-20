<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Notice;


class NoticeController extends Controller
{
    public function actionIndex()
    {
        $model = new Notice;

        return $this->render('index',[
            'dataProvider' => $model->getData(),
        ]);
    }
}
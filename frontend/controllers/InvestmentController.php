<?php

/**
 * Created by getpu on 16/9/18.
 * 创业空间
 */

namespace frontend\controllers;

use frontend\models\Investment;
use Yii;
use yii\web\Controller;


class InvestmentController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = Investment::find()
                      ->where(['cid' => Investment::$cid])
                      ->orderBy(['created_at' => SORT_DESC])
                      ->all();

        return $this->render('index', [
             'model' => $model,
        ]);
    }
}


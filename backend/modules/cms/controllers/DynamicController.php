<?php

/**
 * Created by getpu on 16/8/24.
 */
 
namespace backend\modules\cms\controllers;


class DynamicController extends \getpu\user\controllers\AccessController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCategory()
    {
        return $this->render('category');
    }
}
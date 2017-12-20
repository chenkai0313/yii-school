<?php

/**
 * Created by getpu on 16/8/21.
 */
 
namespace backend\modules\cms\controllers;

class DefaultController extends \getpu\user\controllers\AccessController
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
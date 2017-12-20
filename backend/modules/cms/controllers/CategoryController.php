<?php

/**
 * Created by getpu on 16/8/24.
 */
 
namespace backend\modules\cms\controllers;

class CategoryController extends \getpu\user\controllers\AccessController
{
    /**
     * @return string
     * @meta [文章管理] 文章分类
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
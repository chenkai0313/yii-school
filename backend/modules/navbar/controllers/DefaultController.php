<?php

namespace backend\modules\navbar\controllers;


/**
 * Default controller for the `navbar` module
 */
class DefaultController extends \getpu\user\controllers\AccessController
{
    /**
     * Renders the index view for the module
     * @return string
     * @meta [网站导航] 导航管理
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

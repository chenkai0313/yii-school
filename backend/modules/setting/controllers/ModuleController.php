<?php

namespace backend\modules\setting\controllers;


/**
 * Default controller for the `setting` module
 */
class ModuleController extends \getpu\user\controllers\AccessController
{
    /**
     * Renders the index view for the module
     * @return string
     * @mete [系统设置] 模块管理
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

<?php

/**
 * Created by getpu on 16/8/19.
 */

namespace getpu\mgmt\controllers;

use getpu\user\controllers\AccessController;

class ModuleController extends AccessController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
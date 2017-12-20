<?php

/**
 * Created by getpu on 16/9/23.
 */

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Organize;

class OrganizationController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $items = Organize::find()
                ->where(['cid' => Organize::$cid])
                ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
                ->all();

        return $this->render('index', [
              'items' => $items,
        ]);
    }
}
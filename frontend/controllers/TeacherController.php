<?php

/**
 * Created by getpu on 16/9/8.
 */
 
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Teacher;

class TeacherController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = Teacher::find()->where(['cid' => Teacher::$cid])->all();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
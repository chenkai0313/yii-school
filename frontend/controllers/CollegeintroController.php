<?php

/**
 * Created by getpu on 16/8/31.
 */

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\News;

class CollegeintroController extends Controller {

    public function actionIntro() {
  $rec = News::find()->where(['rec' => 1])->orderBy(['updated_at' => SORT_DESC])->limit(3)->all();



             return $this->render('intro', [
               
                    'rec' => $rec,
        ]);
    }

    public function actionInstitution() {

  $rec = News::find()->where(['rec' => 1])->orderBy(['updated_at' => SORT_DESC])->limit(3)->all();


             return $this->render('institution', [
               
                    'rec' => $rec, ]);
    }

}

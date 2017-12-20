<?php

/**
 * Created by getpu on 16/8/31.
 */

namespace frontend\controllers;

use frontend\models\Article;
use frontend\models\Reprint;
use yii\web\Controller;
use frontend\models\News;
use yii\data\Pagination;

class AnnouncementController extends Controller {

    //动态信息通知公告
    public function actionNotice() {


        $dataProvider = \backend\modules\cms\models\EntrepreneurialInfo::getData();


        $reprints = \backend\modules\cms\models\EntrepreneurialInfo::find()
                ->where(['cid' => '19'])
                ->limit(9)
                ->all();
        return $this->render('notice', [
                    'dataProvider' => $dataProvider,
                    'reprints' => $reprints,
        ]);






        //  return $this->render('notice', get_defined_vars());
    }

}

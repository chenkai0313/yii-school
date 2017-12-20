<?php

/**
 * Created by getpu on 16/9/8.
 * 政策信息
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Banner;
use frontend\models\Policy;
use frontend\models\Research;
use frontend\models\ResearchCase;

class PolicyController extends Controller {

    /**
     * @return string
     * 政策公告
     */
    public function actionIndex() {
        $dataModel = new Policy;
        $dataProvider = $dataModel->getData(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResearch() {
        $banner = Banner::find()->where(['tid' => 41])->orderBy(['sort' => SORT_DESC])->all();

        $dataProvider = (new Research)->getData();

        $case = ResearchCase::find()
                ->where(['cid' => ResearchCase::$cid])
                ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
                ->limit(5)
                ->all();

        return $this->render('research', [
                    'banner' => $banner,
                    'dataProvider' => $dataProvider, //项目
                    'case' => $case, //案例
        ]);
    }

    public function actionFile() {
        $model = \backend\models\Fileupload::find()
                ->all();
        foreach ($model as &$v1) {
            if ($v1['filename']) {
                $content = trim(strip_tags(htmlspecialchars_decode($v1['filename'])));

                $v1['filename'] = mb_strlen($content, 'utf-8') > 40 ? mb_substr($content, 0, 40, 'utf-8') . '...' : $content;
            }
        }




        return $this->render('file', get_defined_vars());
    }

}

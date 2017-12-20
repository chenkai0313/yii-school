<?php

/**
 * Created by getpu on 16/9/18.
 * 创业空间
 */

namespace frontend\controllers;

use frontend\models\Banner;
use Yii;
use frontend\models\Downloads;
use frontend\models\Space;
use yii\web\Controller;
use frontend\models\Category;
use frontend\models\SpaceNotice;

class SpaceController extends Controller
{
    /**
     * @param $cid
     * @return string
     * 创业空间
     */
    public function actionIndex($cid)
    {
        $Space = new SpaceNotice;

        $banner = Banner::find()
                  ->where(['tid' => 42])
                  ->orderBy(['sort' => SORT_DESC])
                  ->all();

        $space = Space::find()
            ->where('cid = :cid', [':cid' => $cid])
            ->orderBy(['updated_at' => SORT_DESC])
            ->one();

        $title = Category::find()
            ->where('id = :cid', [':cid' => $cid])
            ->one();

        //格式 ['0' => '最新公告', '1' => '文件下载'];
        $cates = $Space->getChildCategory($cid);
        $cates[0] = isset($cates[0]) ? $cates[0] : $cid;
        $cates[1] = isset($cates[1]) ? $cates[1] : $cid;

        //最新公告
        $notice = $Space::find()
            ->where(['cid' => $cates[0]])
            ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->limit(9)
            ->all();
            // var_dump($notice);
            // exit();

        //文件下载
        $downloads = Downloads::find()
            ->where(['cid' => $cates[1]])
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(9)
            ->all();

        $this->getView()->title = $title->name;
        return $this->render('index', [
            'banner' => $banner,
            'space' => $space,
            'notices' => $notice,
            'downloads' => $downloads,
        ]);
    }

    public function actionDownload($cid, $id)
    {
        $model = Downloads::find()->where('cid = :cid and id = :id', [':cid' => $cid, ':id' => $id])->one();
        if ($model !== null) {
            $path = $model->path;
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=" . basename($path));
            readfile($path);
        } else {
            header("Content-type: text/html; charset=utf-8");
            echo "File not found!";
            exit;
        }
    }
}
<?php

/**
 * Created by getpu on 16/9/23.
 */
 
namespace backend\modules\cms\controllers;

use Yii;
use backend\modules\cms\models\SpaceNotice;
use backend\modules\cms\models\SpaceNoticeSearch;
use yii\web\NotFoundHttpException;

class SpaceNoticeController extends \getpu\user\controllers\AccessController
{

    /**
     * @return string
     * @meta [创业空间] 最新公告
     */
    public function actionIndex()
    {
        $searchModel = new SpaceNoticeSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     * @meta [创业空间] [最新公告] 添加公告
     */
    public function actionCreate()
    {
        $model = new SpaceNotice;
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }else{
            return $this->render('create',[
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @meta [创业空间] [最新公告] 更新公告
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }else{
            return $this->render('update',[
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @meta [创业空间] [最新公告] 删除公告
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SpaceNotice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SpaceNotice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
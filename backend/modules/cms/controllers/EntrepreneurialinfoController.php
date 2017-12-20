<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\modules\cms\models\EntrepreneurialInfo;
use backend\modules\cms\models\EntrepreneurialInfoSearch;

class EntrepreneurialinfoController extends \getpu\user\controllers\AccessController
{
    /**
     * @return string
     * @meta [动态信息] 创业资讯
     */
    public function actionIndex()
    {
        $searchModel = new EntrepreneurialInfoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @meta [动态信息] [创业资讯] 创建文章
     */
    public function actionCreate()
    {
        $model = new EntrepreneurialInfo;
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
     * @meta [动态信息] [创业资讯] 更新文章
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
     * @meta [动态信息] [创业资讯] 删除文章
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
     * @return EntrepreneurialInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntrepreneurialInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
<?php

namespace backend\modules\videos\controllers;

use Yii;
use backend\modules\videos\models\FronVideos;
use backend\modules\videos\models\FronVidesSearch;
use yii\web\NotFoundHttpException;

/**
 * DefaultController implements the CRUD actions for FronVideos model.
 */
class DefaultController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all FronVideos models.
     * @return mixed
     * @meta [创业干货] 在丝课程
     */
    public function actionIndex()
    {
        $searchModel = new FronVidesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new FronVideos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [创业干货] [在丝课程] 创建文章
     */
    public function actionCreate()
    {
        $model = new FronVideos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FronVideos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [创业干货] [在丝课程] 更新文章
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FronVideos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [创业干货] [在丝课程] 删除文章
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronVideos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FronVideos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FronVideos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\modules\files\controllers;

use Yii;
use backend\modules\files\models\FronDownloads;
use backend\modules\files\models\FronDownloadsSearch;
use getpu\user\controllers\AccessController;
use yii\web\NotFoundHttpException;

/**
 * DownloadsController implements the CRUD actions for FronDownloads model.
 */
class DownloadsController extends AccessController
{
    /**
     * Lists all FronDownloads models.
     * @return mixed
     * @meta [创业空间] 下载文件
     */
    public function actionIndex()
    {
        $searchModel = new FronDownloadsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new FronDownloads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [创业空间] 添加文件
     */
    public function actionCreate()
    {
        $model = new FronDownloads();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FronDownloads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [创业空间] 更新文件
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
     * Deletes an existing FronDownloads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [创业空间] 删除文件
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronDownloads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FronDownloads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FronDownloads::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

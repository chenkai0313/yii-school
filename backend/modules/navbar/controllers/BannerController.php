<?php

namespace backend\modules\navbar\controllers;

use Yii;
use backend\modules\navbar\models\FronBanner;
use backend\modules\navbar\models\bannerSearch;
use yii\web\NotFoundHttpException;

/**
 * BannerController implements the CRUD actions for FronBanner model.
 */
class BannerController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all FronBanner models.
     * @return mixed
     * @meta [网站导航] 横幅管理
     */
    public function actionIndex()
    {
        $searchModel = new bannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FronBanner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FronBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [网站导航] 创建横幅
     */
    public function actionCreate()
    {
        $model = new FronBanner();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FronBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [网站导航] 更新幅横
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
     * Deletes an existing FronBanner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [网站导航] 删除横幅
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FronBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FronBanner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

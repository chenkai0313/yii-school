<?php

namespace backend\modules\cms\controllers;

use Yii;
use backend\modules\cms\models\FronArticle;
use backend\modules\cms\models\FronArticleSearch;
use yii\web\NotFoundHttpException;

/**
 * ArticleController implements the CRUD actions for FronArticle model.
 */
class ArticleController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all FronArticle models.
     * @return mixed
     * @meta [文章管理] 所有文章
     */
    public function actionIndex()
    {
        $searchModel = new FronArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FronArticle model.
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
     * Creates a new FronArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [文章管理] [所有文章] 新建文章
     */
    public function actionCreate()
    {
        $model = new FronArticle();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FronArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [文章管理] [所有文章] 更新文章
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
     * Deletes an existing FronArticle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [文章管理] [所有文章] 删除文章
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
     * @return FronArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FronArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

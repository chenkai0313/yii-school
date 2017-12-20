<?php

namespace backend\modules\cms\controllers;

use Yii;
use backend\modules\cms\models\AssociatedMedia;
use backend\modules\cms\models\AssociatedMediaSearch;
use yii\web\NotFoundHttpException;

/**
 * CompetitionController implements the CRUD actions for AssociatedMedia model.
 */
class AssociatedMediaController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all AssociatedMediaResult models.
     * @return mixed
     * @meta [创业干货] [合作媒体] 所有媒体
     */
    public function actionIndex()
    {
        $searchModel = new AssociatedMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new AssociatedMedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [创业干货] [合作媒体] [所有赛事] 添加媒体
     */
    public function actionCreate()
    {
        $model = new AssociatedMedia;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AssociatedMedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [创业干货] [合作媒体] [所有赛事] 更新媒体
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
     * Deletes an existing AssociatedMedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [创业干货] [合作媒体] [所有赛事] 删除媒体
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the AssociatedMedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssociatedMedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssociatedMedia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

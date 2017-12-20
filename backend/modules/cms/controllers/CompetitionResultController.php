<?php

namespace backend\modules\cms\controllers;

use Yii;
use backend\modules\cms\models\FronArticle;
use backend\modules\cms\models\CompetitionResult;
use backend\modules\cms\models\CompetitionResultSearch;
use yii\web\NotFoundHttpException;

/**
 * CompetitionController implements the CRUD actions for CompetitionResult model.
 */
class CompetitionResultController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all CompetitionResultResult models.
     * @return mixed
     * @meta [动态信息] [创业大赛] 历年成绩
     */
    public function actionIndex()
    {
        $searchModel = new CompetitionResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new CompetitionResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [动态信息] [创业大赛] [历年成绩] 添加成绩
     */
    public function actionCreate()
    {
        $model = new CompetitionResult;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompetitionResult model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [动态信息] [创业大赛] [历年成绩] 更新成绩
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
     * Deletes an existing CompetitionResult model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [动态信息] [创来大赛] [历年成绩] 删除成绩
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompetitionResult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompetitionResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompetitionResult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\modules\cms\controllers;

use Yii;
use backend\modules\cms\models\CompetitionAssort;
use backend\modules\cms\models\CompetitionAssortSearch;
use backend\modules\cms\models\CompetitionAssortTags;
use backend\modules\cms\models\CompetitionAssortResult;
use backend\modules\cms\models\CompetitionAssortResultSearch;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CompetitionController implements the CRUD actions for CompetitionAssort model.
 */
class CompetitionAssortController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all CompetitionAssortResult models.
     * @return mixed
     * @meta [动态信息] [创业赛事] 所有赛事
     */
    public function actionIndex()
    {
        $searchModel = new CompetitionAssortSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new CompetitionAssort model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [动态信息] [创业赛事] [所有赛事] 添加赛事
     */
    public function actionCreate()
    {
        $model = new CompetitionAssort;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompetitionAssort model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [动态信息] [创业赛事] [所有赛事] 更新赛事
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tags  = new CompetitionAssortTags;
        $result = new CompetitionAssortResult;
        $searchModel = new CompetitionAssortResultSearch($id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tags'  => $tags,
                'result' => $result,
                'tags_list' => $tags->getData($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing CompetitionAssort model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [动态信息] [创业赛事] [所有赛事] 删除赛事
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Create an CompetitionAssortTags model
     * @meta [动态信息] [创业赛事] [历年成绩] 添加标签
     */
    public function actionCreateTags()
    {
        $model = new CompetitionAssortTags;
        if($model->load(Yii::$app->request->post()) && !$model->save()){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
    }

    /**
     * Delete an CompetitionAssortTags model
     * @meta [动态信息] [创业赛事] [历年成绩] 删除标签
     */
    public function actionDeleteTags($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = CompetitionAssortTags::findOne($id);
        if(($model !== null) && $model->delete()){
            return ['status' => 1];
        }
        return ['status' => 0];
    }

    /**
     * Create an CompetitionAssortResult model
     * @meta [动态信息] [创业大赛] [历年成绩] 添加成绩
     */
    public function actionCreateResult()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new CompetitionAssortResult;
        if($model->load(Yii::$app->request->post()) && !$model->save()){
            return \yii\widgets\ActiveForm::validate($model);
        }
        return ['status' => 1];
    }

    /**
     * Delete an CompetitionAssortResult model
     * @meta [动态信息] [创业大赛] [历年成绩] 删除成绩
     */
    public function actionDeleteResult($id)
    {
        $model = CompetitionAssortResult::findOne($id);
        if(($model !== null) && $model->delete()){
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Finds the CompetitionAssort model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompetitionAssort the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompetitionAssort::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

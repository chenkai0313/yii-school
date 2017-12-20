<?php

namespace backend\modules\cms\controllers;

use Yii;
use backend\modules\cms\models\FronArticle;
use backend\modules\cms\models\FronCompetitionForm;
use backend\modules\cms\models\FronCompetition;
use backend\modules\cms\models\FronCompetitionSearch;
use yii\web\NotFoundHttpException;

/**
 * CompetitionController implements the CRUD actions for FronCompetition model.
 */
class CompetitionController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all FronCompetition models.
     * @return mixed
     * @meta [动态信息] [创业大赛] 所有赛事
     */
    public function actionIndex()
    {
        $searchModel = new FronCompetitionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new FronCompetition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [动态信息] [创业大赛] 创建赛事
     */
    public function actionCreate()
    {
        $model = new FronCompetitionForm;
        $model->fronArticle = new FronArticle;
        $model->setAttributes(Yii::$app->request->post());
        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FronCompetition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [动态信息] [创业大赛] 更新赛事
     */
    public function actionUpdate($id)
    {
        $model = new FronCompetitionForm;
        $model->fronArticle = $this->findModel($id);
        $model->setAttributes(Yii::$app->request->post());
        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FronCompetition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [动态信息] [创来大赛] 删除赛事
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronCompetition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FronCompetition the loaded model
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

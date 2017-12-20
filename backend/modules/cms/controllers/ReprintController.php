<?php

namespace backend\modules\cms\controllers;

use Yii;
use backend\modules\cms\models\FronReprint;
use backend\modules\cms\models\FronReprintSearch;
use yii\web\NotFoundHttpException;


/**
 * ReprintController implements the CRUD actions for FronReprint model.
 */
class ReprintController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all FronReprint models.
     * @return mixed
     * @meta [文章管理] 转载文章
     */
    public function actionIndex()
    {
        $searchModel = new FronReprintSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new FronReprint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [文章管理] 创建转载文章
     */
    public function actionCreate()
    {
        $model = new FronReprint;



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FronReprint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [文章管理] 更新转载文章
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /*
        if(Yii::$app->request->isPost) {
            var_dump(Yii::$app->request->post());
            die;
        }
        */

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FronReprint model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [文章管理] 删除转载文章
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronReprint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FronReprint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FronReprint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

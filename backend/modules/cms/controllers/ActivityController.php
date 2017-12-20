<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\controllers;

use backend\modules\cms\models\FronCompetitionJoin;
use Yii;
use yii\web\NotFoundHttpException;
use backend\modules\cms\models\Activity;
use backend\modules\cms\models\ActivityExtension;
use backend\modules\cms\models\ActivitySearch;

class ActivityController extends \getpu\user\controllers\AccessController
{
    /**
     * @return string
     * @meta 精品活动
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @meta [精品活动] 创建文章
     */
    public function actionCreate()
    {
        $model = new Activity;
        //$exten = new ActivityExtension;
        $join  = new FronCompetitionJoin;
        $load = $model->load(Yii::$app->request->post())
                && $join->load(Yii::$app->request->post());
        if($load && $model->save()){
            $join->aid = $model->id;
            $join->save();
            return $this->redirect(['index']);
        }else{
            return $this->render('create',[
                'model' => $model,
                'join' => $join,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @meta [精品活动] 更新文章
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$exten = ActivityExtension::findOne($model->id);
        $join = FronCompetitionJoin::findOne($model->id);
        $load = $model->load(Yii::$app->request->post())
                && $join->load(Yii::$app->request->post());
        if($load && $model->save() && $join->save()){
            return $this->redirect(['index']);
        }else{
            return $this->render('update',[
               'model' => $model,
               'join' => $join,
            ]);
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @meta [精品活动] 删除文章
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        FronCompetitionJoin::findOne($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
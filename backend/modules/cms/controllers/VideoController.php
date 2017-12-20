<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\modules\cms\models\Video;
use backend\modules\cms\models\VideoSearch;

class VideoController extends \getpu\user\controllers\AccessController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Video;
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }else{
            return $this->render('create',[
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }else{
            return $this->render('update',[
               'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
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
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
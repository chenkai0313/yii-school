<?php

/**
 * Created by getpu on 16/9/12.
 */
 
namespace frontend\controllers;

use frontend\models\Banner;
use Yii;
use yii\web\Controller;
use frontend\models\Videos;
use frontend\models\Comment;
use yii\web\Response;

class VideosController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $banner = Banner::find()->where(['tid' => 43])->orderBy(['sort' => SORT_ASC])->all();
        $searchModel = new Videos;
        $dataProvider  = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'banner' => $banner,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionDetail($id)
    {
        $model = Videos::findOne($id);
        if($model !== null){
            $model->updateCounters(['clicked' => 1]);
        }
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $comment = new Comment;
            if($comment->load(Yii::$app->request->post()) && $comment->save()){
                return ['status' => 1 ];
            }
            return ['status' => 0 ];
        }else{
            return $this->render('detail', [
                'model' => $model,
                'comment_count' => Comment::find()->where(['cid' => $id, 'review' => 1])->count(),
            ]);
        }
    }

    /**
     * @return array
     */
    public function actionComments()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Comment;
        $model->load(Yii::$app->request->queryParams);
        $dataProvider = $model->getData();
        $data = [];
        foreach($dataProvider->getModels() as $k => $item){
            $data[$k]['time'] = date('Y-m-d H:i:s',$item->created_at);
            $data[$k]['content'] = \yii\helpers\Html::encode($item->content);
        }
        return [
            'data' => $data,
        ];
    }
}
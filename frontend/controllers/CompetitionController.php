<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace frontend\controllers;

use Yii;
use frontend\models\Article;
use yii\web\Controller;
use frontend\models\Competition;
use frontend\models\CompetitionResult;
use frontend\models\CompetitionAssort;
use yii\web\Response;
use yii\helpers\Url;
use frontend\helpers\Common;

class CompetitionController extends Controller
{

    public function actionIndex()
    {
        $model = new Competition;
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $items = $model->dataProvider(Yii::$app->request->post());
            $data = [];
            foreach($items->getModels() as $k => $item) {
                if($item->end_time > time()){
                    $item->status = 0;
                    $item->save(false);
                }else if($item->end_time < time()){
                    $item->status = 1;
                    $item->save(false);
                }
               $data[$k]['title'] = $item->article->title;
               $data[$k]['img']  = $item->article->files->host .DIRECTORY_SEPARATOR. $item->article->files->name;
               $data[$k]['str_time'] = date('Y-m-d', $item->str_time);
               $data[$k]['end_time'] = date('Y-m-d', $item->end_time);
               $data[$k]['url'] = Url::to(['news/detail', 'cid' => $item->article->category->id, 'id' => $item->aid]);
               $data[$k]['status'] = $item->status;
               $data[$k]['clicked'] = $item->article->clicked;
               $data[$k]['residual_time'] = $item->status ? null : Common::residualTime($item->end_time);
            }
            return [
              'data' => $data,
              'page' => $items->getPagination(),
            ];
        } else {
            return $this->render('index',[
                'data' => $model->dataProvider(Yii::$app->request->post()),
            ]);
        }
    }

    public function actionAssort()
    {
        $model = new CompetitionAssort;
        return $this->render('assort',[
            'data' => $model->getData(),
        ]);
    }

    /**
     * @param $cid
     * @param $id
     * @return string
     */
    public function actionDetail($cid,$id)
    {
        $model = new CompetitionResult;
        $detail = Article::find()->where('cid = :cid and id = :id',[':cid' => $cid, ':id' => $id])->one();
        $result = $model->data($id);

        $rec = Article::find()->where('cid = :cid and rec = :rec',[':cid' => $cid,':rec' => 1])->orderBy(['updated_at' => SORT_ASC])->limit(20)->all();

        if($detail !== null){
            $detail->updateCounters(['clicked' => 1]);
        }
        return $this->render('detail',[
            'detail' => $detail, //详情
            'result' => $result, //历年成绩
            'rec' => $rec,
        ]);
    }

}


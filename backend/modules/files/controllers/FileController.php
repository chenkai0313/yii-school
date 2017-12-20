<?php

/**
 * Created by getpu on 16/8/25.
 */

namespace backend\modules\files\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\modules\files\models\FronFiles;

class FileController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                   [
                       'allow' => true,
                       'roles' => ['@'],
                   ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionLayout()
    {

        return $this->render('layout');
    }

    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            $model = new FronFiles;
            $file = $_FILES['file']['name'];
            if ($model->validate() && $model->save()) {
                return ['success' => $file . '上传成功'];
            }
            return ['error' => $file . '上传失败'];
        }
    }

    public function actionNotify()
    {
        // 获取notify通知的body信息
        $notifyBody = file_get_contents('php://input');

       // 业务服务器处理通知信息， 这里直接打印在log中
        error_log($notifyBody);
    }


}
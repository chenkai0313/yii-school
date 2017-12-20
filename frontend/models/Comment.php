<?php

/**
 * Created by getpu on 16/9/13.
 * 创业干货 在线课程
 */

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

class Comment extends \backend\modules\videos\models\FronComment
{
    public function beforeValidate()
    {
        if(Yii::$app->request->cookies->has('_comment')){
            $this->addError('content',Yii::t('app', 'Time out'));
        }
        return parent::beforeValidate();
    }


    public function afterSave($insert,$changeAttributes)
    {
        parent::afterSave($insert,$changeAttributes);
        if($insert){
            $cookie = Yii::$app->response->cookies;
            $cookie->add(new \yii\web\Cookie([
                'name'  => '_comment',
                'value' => Yii::$app->request->userIP,
                'expire' => time() + 360,
            ]));
        }
    }

    public function getData()
    {
        return new ActiveDataProvider([
            'query' => Comment::find()->where(['cid' => $this->cid, 'review' => 1]),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);
    }
}

<?php

/**
 * Created by getpu on 16/8/23.
 */

namespace backend\modules\setting\models;

use Yii;
use yii\base\Model;

class Qiniusite extends Model
{

    public $qiniu_host;
    public $qiniu_accesskey;
    public $qiniu_secretkey;  // seo 关键字
    public $qiniu_bucket;
    public $qiniu_pipeline;
    public $qiniu_notify;
    public $qiniu_vframe;

    public function init()
    {
        $model = FronConfig::findAll(['name' => $this->attributes()]);
        foreach($model as $m){
            $this->{$m->name} = $m->value;
        }
    }

    public function rules()
    {
        return [
            [['qiniu_host','qiniu_accesskey','qiniu_secretkey','qiniu_bucket'],'required'],
            [['qiniu_host','qiniu_accesskey','qiniu_secretkey','qiniu_bucket','qiniu_pipeline','qiniu_notify','qiniu_vframe'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'qiniu_host' => Yii::t('app','Qiniu host'),
            'qiniu_accesskey' => Yii::t('app','Qiniu accessKey'),
            'qiniu_secretkey' => Yii::t('app','Qiniu secretKey'),
            'qiniu_bucket' => Yii::t('app','Qiniu bucket'),
            'qiniu_pipeline' => Yii::t('app','Qiniu pipeline'),
            'qiniu_notify' => Yii::t('app','Qiniu notify'),
            'qiniu_vframe' => Yii::t('app', 'Qiniu vframe'),
        ];
    }

    public function saveAll()
    {
        foreach ($this->attributes as $name => $value){
            $this->saveOne($name,$value);
        }
        return true;
    }

    protected function saveOne($name,$value = null)
    {
        $model  = FronConfig::findOne(['name' => $name]);
        if ($model !== null ) {
            $model->value = $value;
            $model->update();
        } else {
            $model = new FronConfig;
            $model->name = $name;
            $model->value = $value;
            $model->save();
        }
    }

}
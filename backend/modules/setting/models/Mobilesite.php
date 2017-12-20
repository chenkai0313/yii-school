<?php

/**
 * Created by getpu on 16/8/23.
 */

namespace backend\modules\setting\models;

use Yii;
use yii\base\Model;

class Mobilesite extends Model
{
    public $mobile_site;
    public $mobile_title;
    public $mobile_keywords;  // seo 关键字
    public $mobile_description; //seo 简介
    public $mobile_icp; // 备案号
    public $mobile_copyright; //版权信息
    public $mobile_mobile;
    public $mobile_email;
    public $mobile_address;
    public $mobile_traffic;

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
            [['mobile_site','mobile_title','mobile_keywords','mobile_description','mobile_icp','mobile_copyright','mobile_mobile','mobile_email','mobile_address','mobile_traffic'],'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'mobile_site' => Yii::t('app','Web site'),
            'mobile_title' => Yii::t('app','Web title'),
            'mobile_keywords' => Yii::t('app','Web keywords'),
            'mobile_description' => Yii::t('app','Web description'),
            'mobile_icp'     =>      Yii::t('app','Web icp'),
            'mobile_copyright' =>  Yii::t('app','Web copyright'),
            'mobile_mobile'    => Yii::t('app','Web mobile'),
            'mobile_email'     => Yii::t('app','Web email'),
            'mobile_address'   => Yii::t('app','Web address'),
            'mobile_traffic'   => Yii::t('app','Web traffic'),
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
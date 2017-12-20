<?php

/**
 * Created by getpu on 16/8/23.
 */

namespace backend\modules\setting\models;

use Yii;
use yii\base\Model;

class Website extends Model {

    public $web_site;
    public $web_title;
    public $web_keywords;  // seo 关键字
    public $web_description; //seo 简介
    public $web_icp; // 备案号
    public $web_copyright; //版权信息
    public $web_mobile;
    public $web_email;
    public $web_fax;
    public $web_phone;
    public $web_address;
    public $web_traffic;
    public $web_intro;
    public $web_institution;

    public function init() {
        $model = FronConfig::findAll(['name' => $this->attributes()]);
        foreach ($model as $m) {
            $this->{$m->name} = $m->value;
        }
    }

    public function rules() {
        return [
            [['web_site', 'web_title', 'web_intro', 'web_institution', 'web_keywords', 'web_description', 'web_icp', 'web_copyright', 'web_mobile', 'web_fax', 'web_phone', 'web_email', 'web_address', 'web_traffic'], 'string']
        ];
    }

    public function attributeLabels() {
        return [
            'web_site' => Yii::t('app', 'Web site'),
            'web_title' => Yii::t('app', 'Web title'),
            'web_keywords' => Yii::t('app', 'Web keywords'),
            'web_description' => Yii::t('app', 'Web description'),
            'web_icp' => Yii::t('app', 'Web icp'),
            'web_copyright' => Yii::t('app', 'Web copyright'),
            'web_mobile' => Yii::t('app', 'Web mobile'),
            'web_fax' => Yii::t('app', 'Web fax'),
            'web_phone' => Yii::t('app', 'Web phone'),
            'web_email' => Yii::t('app', 'Web email'),
            'web_address' => Yii::t('app', 'Web address'),
            'Web_traffic' => Yii::t('app', 'Web traffic'),
            'web_intro' => Yii::t('app', 'Web intro'),
            'web_institution' => Yii::t('app', 'Web institution'),
        ];
    }

    public function saveAll() {
        foreach ($this->attributes as $name => $value) {
            $this->saveOne($name, $value);
        }
        return true;
    }

    protected function saveOne($name, $value = null) {
        $model = FronConfig::findOne(['name' => $name]);
        if ($model !== null) {
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

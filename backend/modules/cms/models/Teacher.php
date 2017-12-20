<?php

/**
 * Created by getpu on 16/9/7.
 */

namespace backend\modules\cms\models;

use Yii;

class Teacher extends FronArticle
{
    public static $cid = 40;

    public function rules()
    {
        return array_merge(
            [[['tag'],'string','max' => 11]],
            parent::rules()
        );
    }
    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['fid'] = Yii::t('app', 'Teacher avatar');
        $labels['title'] = Yii::t('app','Teacher name');
        $labels['tag'] = Yii::t('app', 'Teacher mobile');
        return $labels;
    }
}
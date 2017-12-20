<?php

/**
 * Created by getpu on 16/9/6.
 * 创业赛事
 */

namespace frontend\models;

use yii\data\ActiveDataProvider;

class CompetitionAssort extends \backend\modules\cms\models\CompetitionAssort
{
    public function getData()
    {
        return new ActiveDataProvider([
            'query' => self::find()->where(['cid' => self::$cid]),
        ]);
    }
}
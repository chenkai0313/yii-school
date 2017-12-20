<?php

/**
 * Created by getpu on 16/9/24.
 * 科研转化
 */

namespace frontend\models;

use yii\data\ActiveDataProvider;

class Research extends \backend\modules\cms\models\Research
{
    /**
     * @return ActiveDataProvider
     */
    public function getData()
    {
        return new ActiveDataProvider([
            'query' => Research::find()->where(['cid' => Research::$cid]),
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);
    }
}
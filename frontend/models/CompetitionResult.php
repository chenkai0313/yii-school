<?php

/**
 * Created by getpu on 16/9/6.
 * 历年成绩
 */

namespace frontend\models;

class CompetitionResult extends \backend\modules\cms\models\CompetitionAssortResult
{

    public function data($aid)
    {
        $query = self::find()
            ->joinWith(['tags'])
            ->where('fron_competition_assort_tags.aid = :aid',[':aid' => $aid] )
            ->orderBy(['fron_competition_assort_result.created_at' => SORT_DESC])
            ->all();
        return $query;
    }


}
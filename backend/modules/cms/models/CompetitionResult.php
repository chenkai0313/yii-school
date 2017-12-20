<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

use Yii;
use yii\helpers\ArrayHelper;

class CompetitionResult extends FronArticle
{
    public static $cid = 54;

    public function rules()
    {
        return array_merge(
          [[['cid'],'in','range' => ArrayHelper::getColumn(self::getChildrenCategory()->asArray()->all(),'id')]],
          parent::rules()
        );
    }

    public static function getChildrenCategory()
    {
        return FronCategory::findOne(self::$cid)->children(1);
    }
}
<?php

namespace backend\modules\cms\models;

class FronCategory extends \getpu\tree\models\Tree
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_category';
    }

}

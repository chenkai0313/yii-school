<?php

namespace backend\modules\setting\models;

class FronModule extends \getpu\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_module';
    }
}

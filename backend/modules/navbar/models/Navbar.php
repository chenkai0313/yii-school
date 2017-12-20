<?php

/**
 * Created by getpu on 16/8/24.
 */
 
namespace backend\modules\navbar\models;


class Navbar extends \getpu\tree\models\Tree
{
    public $encodeNodeNames = false;

    public $purifyNodeIcons = true;

    public static function tableName()
    {
        return 'fron_navbar';
    }
}
<?php

/**
 * Created by getpu on 16/9/1.
 */
 
namespace backend\modules\setting\models;

use yii\caching\FileCache;
use frontend\models\Cache;

class Cached extends FileCache
{
    public $cachePath = '@frontend/runtime/cache';

    public $keyPrefix = '_zju_';

    /**
     * @var array
     * cache all keys
     */
    public $keys = [];

    public function init()
    {
        parent::init();
        foreach(get_class_methods(Cache::className()) as $name){
            if(substr($name,0,3) === 'get'){
                array_push($this->keys, lcfirst(substr($name,3)));
            }
        }
    }
}
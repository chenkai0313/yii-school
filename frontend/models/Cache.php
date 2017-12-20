<?php

/**
 * Created by getpu on 16/9/1.
 */
 
namespace frontend\models;

use Yii;

class Cache extends \yii\base\Object
{
    public static $duration = 86400;

    /**
     * @return mixed
     * 网站全局配置
     */
    public static function getWebConfig()
    {
        $c = Yii::$app->cache;
        if(!$c->exists('webConfig')){
            $data = [];
            $model = new Website;
            foreach($model->attributes() as $attr){
                $data[$attr] = $model->{$attr};
            }
            $c->set('webConfig',$data,self::$duration);
        }
        return $c->get('webConfig');
    }

    /**
     * @return mixed
     * 头部导航
     */
    public static function getHeaderNav()
    {
       $c = Yii::$app->cache;
       if(!$c->exists('headerNav')){
           $data = Navbar::makeTree(Navbar::findOne(['name' => '头部导航'])->children(1));
           $c->set('headerNav',$data,self::$duration);
       }
       return $c->get('headerNav');
    }

    /**
     * @return mixed
     * 底部导航
     */
    public static function getFooterNav()
    {
        $c = Yii::$app->cache;
        if(!$c->exists('footerNav')){
            $data = Navbar::makeTree(Navbar::findOne(11)->children(1));
            $c->set('footerNav',$data,self::$duration);
        }
        return $c->get('footerNav');
    }

}
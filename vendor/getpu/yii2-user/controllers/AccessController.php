<?php

/**
 * Created by getpu on 16/8/19.
 */
 
namespace getpu\user\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use getpu\user\filters\AccessRule;



class AccessController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            $user = \Yii::$app->user->identity;
                            return in_array($user->username, $user->module->admins)
                                   || \Yii::$app->user->can($this->route());
                        },
                    ],
                ],
            ],
        ];
    }

    private function route()
    {
        $route = \Yii::$app->requestedRoute;
        $arr   = explode(DIRECTORY_SEPARATOR, $route);
        if(is_array($arr) && count($arr) < 3 ){
            return DIRECTORY_SEPARATOR . $route . DIRECTORY_SEPARATOR . 'index';
        }else{
            return DIRECTORY_SEPARATOR . $route;
        }
    }
}

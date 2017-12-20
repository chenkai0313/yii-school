<?php

namespace getpu\rbac\controllers;

use yii\web\NotFoundHttpException;
use yii\rbac\Item;
use getpu\rbac\models\Route;
use getpu\rbac\models\Permission;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class PermissionController extends ItemControllerAbstract
{
    /** @var string */
    protected $modelClass = 'getpu\rbac\models\Permission';
    
    /** @var int */
    protected $type = Item::TYPE_PERMISSION;

    /**
     * @return \yii\web\Response
     */
    public function actionRoute()
    {
        $routes = (new Route)->filterMetaRoutes();
        if($routes){
            foreach($routes as $route){
                $model = new Permission;
                $model->name = $route['route'];
                $model->description = $route['meta'];
                $model->setScenario('create');
                $model->save(false);
            }
            \Yii::$app->getSession()->setFlash('success',\Yii::t('rbac','Successfully updated all permission'));
            return $this->redirect(['index']);
        }
        \Yii::$app->getSession()->setFlash('danger',\Yii::t('rbac','Update failed'));
        return $this->redirect(['index']);
    }

    /** @inheritdoc */
    protected function getItem($name)
    {
        $role = \Yii::$app->authManager->getPermission($name);

        if ($role instanceof \yii\rbac\Permission) {
            return $role;
        }
        throw new NotFoundHttpException;
    }
}
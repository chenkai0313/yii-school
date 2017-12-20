<?php


namespace getpu\user\traits;

use getpu\user\Module;

/**
 * Trait ModuleTrait
 * @property-read Module $module
 * @package getpu\user\traits
 */
trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('user');
    }
}

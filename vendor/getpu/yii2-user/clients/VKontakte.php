<?php

/*** Created by getpu on 16/8/19.*/

namespace getpu\user\clients;

use Yii;
use yii\authclient\clients\VKontakte as BaseVKontakte;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class VKontakte extends BaseVKontakte implements ClientInterface
{
    /** @inheritdoc */
    public $scope = 'email';

    /** @inheritdoc */
    public function getEmail()
    {
        return $this->getAccessToken()->getParam('email');
    }

    /** @inheritdoc */
    public function getUsername()
    {
        return isset($this->getUserAttributes()['screen_name'])
            ? $this->getUserAttributes()['screen_name']
            : null;
    }

    /** @inheritdoc */
    protected function defaultTitle()
    {
        return Yii::t('user', 'VKontakte');
    }
}

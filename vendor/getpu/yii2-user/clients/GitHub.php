<?php

/*** Created by getpu on 16/8/19.*/

namespace getpu\user\clients;

use yii\authclient\clients\GitHub as BaseGitHub;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class GitHub extends BaseGitHub implements ClientInterface
{
    /** @inheritdoc */
    public function getEmail()
    {
        return isset($this->getUserAttributes()['email'])
            ? $this->getUserAttributes()['email']
            : null;
    }

    /** @inheritdoc */
    public function getUsername()
    {
        return isset($this->getUserAttributes()['login'])
            ? $this->getUserAttributes()['login']
            : null;
    }
}

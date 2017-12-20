<?php

/*** Created by getpu on 16/8/19.*/

namespace getpu\user\clients;

use yii\authclient\clients\Google as BaseGoogle;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Google extends BaseGoogle implements ClientInterface
{
    /** @inheritdoc */
    public function getEmail()
    {
        return isset($this->getUserAttributes()['emails'][0]['value'])
            ? $this->getUserAttributes()['emails'][0]['value']
            : null;
    }

    /** @inheritdoc */
    public function getUsername()
    {
        return;
    }
}

<?php

/**
 * Created by getpu on 16/8/27.
 */

namespace backend\modules\files\models;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;
use Qiniu\Processing\PersistentFop;
use backend\modules\setting\models\Qiniusite;
use yii\base\InvalidValueException;

class Qiniu extends \yii\base\Model
{
    /**
     * @var
     * qiniu auth
     */
    public $auth;

    /**
     * @var Qiniusite
     */
    public $config;

    /**
     * @var
     * qiniu required field
     */
    public $filed = [
        'qiniu_host',
        'qiniu_accesskey',
        'qiniu_secretkey',
        'qiniu_bucket',
    ];

    public function __construct($config = [])
    {
        $this->config = new Qiniusite;
        return parent::__construct($config);
    }

    public function init()
    {
        foreach ($this->filed as $v) {
            if (empty($this->config->{$v})) {
                throw new InvalidValueException("The {$v} must be set");
            }
        }
        if (!$this->getAuth()) {
            throw new InvalidValueException("Qiniu auth get failed");
        }
        if (!isset($this->config->qiniu_pipeline)) {
            $this->config->qiniu_pipeline = null;
        }
        if (!isset($this->config->qiniu_notify)) {
            $this->config->qiniu_notify = null;
        }
        if (!isset($this->config->qiniu_vframe)) {
            $this->config->qiniu_vframe = 'vframe/jpg/offset/3/w/480/h/360';
        }
    }

    /**
     * @return Auth
     */
    public function getAuth()
    {
        return $this->auth = new Auth(
            $this->config->qiniu_accesskey,
            $this->config->qiniu_secretkey
        );
    }

    /**
     * @param $key
     * @param $file
     * @return array
     */
    public function UploadManager($key, $file)
    {
        $uploadMgt = new UploadManager;
        return $uploadMgt->putFile($this->createUploadToken(), $key, $file);
    }

    public function PersistentFop($key)
    {
        $pfop = new PersistentFop($this->auth,
            $this->config->qiniu_bucket,
            $this->config->qiniu_pipeline,
            $this->config->qiniu_notify
        );
        list($id, $err) = $pfop->execute($key, $this->config->qiniu_vframe);
        return  $pfop->status($id);
    }


    public function createUploadToken()
    {
        return $this->auth->uploadToken($this->config->qiniu_bucket);
    }


}
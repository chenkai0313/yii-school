<?php

/**
 * Created by getpu on 16/8/25.
 */

namespace backend\modules\files\behaviors;

use yii\base\Behavior;
use yii\base\InvalidValueException;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;
use Faker\Provider\Uuid;
use backend\modules\files\models\Qiniu;


/**
 * Class FileUploadBehavior
 * @package backend\modules\files\behaviors
 */

class FileUploadBehavior extends Behavior
{
    const IMAGES = 1;
    const VIDEOS = 2;
    const PDFS = 3;

    /**
     * @var string
     * form name
     */
    public $formAttribute = 'file';  // form 表单

    public $tidAttribute = 'tid';

    public $hostAttribute = 'host';

    public $nameAttribute = 'name';

    public $extensionAttribute = 'extension';

    public $sizeAttribute = 'size';

    public $file;

    public $Qiniu;

    public $allowFiles = [
        self::IMAGES => [
            'extension' => ['jpg', 'jpeg', 'gif'],
        ],
        self::VIDEOS => [
            'extension' => ['mp4', 'rmvb', 'avi'],
        ],
        self::PDFS => [
            'extension' => ['pdf'],
        ],
    ];


    public function init()
    {
        if ($this->formAttribute === null) {
            throw new InvalidValueException("The {$this->formAttribute} must be set");
        }
        if ($this->tidAttribute === null) {
            throw new InvalidValueException("The {$this->tidAttribute} must be set");
        }
        if ($this->hostAttribute === null) {
            throw new InvalidValueException("The {$this->hostAttribute} must be set");
        }
        if ($this->nameAttribute === null) {
            throw new InvalidValueException("The {$this->nameAttribute} must be set");
        }
        if ($this->extensionAttribute === null) {
            throw new InvalidValueException("The {$this->extensionAttribute} must be set");
        }
        if ($this->sizeAttribute === null) {
            throw new InvalidValueException("The {$this->sizeAttribute} must be set");
        }
      //  $this->Qiniu = new Qiniu;
    }


    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
        ];
    }

    public function beforeValidate()
    {
        $this->Qiniu = new Qiniu;
        if ($this->owner->{$this->formAttribute} instanceof UploadedFile) {
            $this->file = $this->owner->{$this->formAttribute};
            return;
        }
        $this->file = UploadedFile::getInstance($this->owner, $this->formAttribute);
        if (empty($this->file)) {
            $this->file = UploadedFile::getInstanceByName($this->formAttribute);
        }
        if ($this->file instanceof UploadedFile) {
            $this->owner->{$this->formAttribute} = $this->file;
        }
        if ($this->getTid()) {
            $this->owner->{$this->tidAttribute} = $this->getTid();
            $this->owner->{$this->hostAttribute} = $this->Qiniu->config->qiniu_host;
            $this->owner->{$this->nameAttribute} = Uuid::uuid();
            $this->owner->{$this->extensionAttribute} = $this->file->extension;
            $this->owner->{$this->sizeAttribute} = $this->file->size;
        } else {
            $this->owner->addError($this->extensionAttribute, \Yii::t('app', 'The file extension is not allow'));
        }
    }

    public function beforeSave()
    {
        if (!$this->owner->isNewRecord) {
            $this->owner->{$this->nameAttribute} = $this->file->name;
        }
        list($ret, $err) = $this->Qiniu->UploadManager($this->owner->{$this->nameAttribute}, $this->file->tempName);
        if($err){
            $this->owner->addError($this->extensionAttribute, \Yii::t('app', 'Qiniu upload is failed'));
        }
        if($ret && $this->owner->{$this->tidAttribute} === self::VIDEOS){
            $this->vframe();
        }
    }

    protected function vframe()
    {
        list($ret, $err) = $this->Qiniu->PersistentFop($this->owner->{$this->nameAttribute});
        if ($err !== null) {
            $this->owner->addError($this->extensionAttribute, \Yii::t('app', 'Vframe is not save'));
        }
    }

    protected function getTid()
    {
        if (is_array($this->allowFiles)) {
            foreach ($this->allowFiles as $k => $v) {
                if (is_object($this->file) && in_array($this->file->extension, $v['extension'])) {
                    return $k;
                }
            }
            return null;
        }
        throw new InvalidValueException('The allowFiles undefined');
    }

}
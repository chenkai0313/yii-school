<?php

namespace backend\modules\navbar\models;

use backend\modules\files\models\FronFiles;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "fron_banner".
 *
 * @property integer $id
 * @property integer $tid
 * @property integer $fid
 * @property integer $sort
 * @property string $url
 * @property string $desc
 * @property integer $created_at
 */
class FronBanner extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid', 'fid'], 'required'],
            [['tid', 'fid', 'sort', 'created_at'], 'integer'],
            [['sort'],'default', 'value' => 0],
            [['url'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tid' => Yii::t('app', 'Tid'),
            'fid' => Yii::t('app', 'Fid image'),
            'sort' => Yii::t('app', 'Sort'),
            'url' => Yii::t('app', 'Url'),
            'desc' => Yii::t('app', 'Desc'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getFiles()
    {
        return $this->hasOne(FronFiles::className(),['id' => 'fid']);
    }

    public function getNavbar()
    {
        return $this->hasOne(Navbar::className(),['id' => 'tid']);
    }
}

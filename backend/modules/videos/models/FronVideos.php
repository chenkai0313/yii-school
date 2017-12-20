<?php

namespace backend\modules\videos\models;

use Yii;
use backend\modules\files\models\FronFiles;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "fron_videos".
 *
 * @property integer $id
 * @property integer $fid
 * @property string $path
 * @property string $title
 * @property string $desc
 * @property integer $rec
 * @property integer $clicked
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronVideos extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid', 'path', 'time', 'title', 'desc'], 'required'],
            [['fid', 'rec', 'clicked', 'created_at', 'updated_at'], 'integer'],
            [['path', 'title'], 'string', 'max' => 255],
            [['time'], 'string', 'max' => 8],
            [['time'], 'default', 'value' => '00:00'],
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
            'fid' => Yii::t('app', 'Fid cover'),
            'path' => Yii::t('app', 'Video Path'),
            'time' => Yii::t('app', 'Video Time'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'rec' => Yii::t('app', 'Rec'),
            'clicked' => Yii::t('app', 'Clicked'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getFiles()
    {
        return $this->hasOne(FronFiles::className(), ['id' => 'fid']);
    }
}

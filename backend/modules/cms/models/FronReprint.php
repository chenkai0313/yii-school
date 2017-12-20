<?php

namespace backend\modules\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "fron_reprint".
 *
 * @property integer $id
 * @property string $title
 * @property string $source
 * @property string $desc
 * @property string $url
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronReprint extends \yii\db\ActiveRecord
{


    public function behaviors()
    {
        return [
            'Timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_reprint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['created_at'],'date', 'timestampAttribute' => 'created_at', 'format' => 'php:Y-m-d'],
            [['title', 'url'], 'string', 'max' => 255],
            [['source'], 'string', 'max' => 64],
            [['desc'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'source' => Yii::t('app', 'Source'),
            'desc' => Yii::t('app', 'Desc'),
            'url' => Yii::t('app', 'Url'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}

<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_reprint}}".
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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_reprint}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
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
            'id' => 'ID',
            'title' => '转载标题',
            'source' => '来源',
            'desc' => '简介',
            'url' => '原链接',
            'created_at' => '转载时间',
            'updated_at' => '更新时间',
        ];
    }

}

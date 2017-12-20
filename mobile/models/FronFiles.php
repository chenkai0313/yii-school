<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_files}}".
 *
 * @property integer $id
 * @property integer $tid
 * @property string $host
 * @property string $name
 * @property string $extension
 * @property integer $size
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid', 'name', 'extension', 'size', 'created_at', 'updated_at'], 'required'],
            [['tid', 'size', 'created_at', 'updated_at'], 'integer'],
            [['host'], 'string', 'max' => 512],
            [['name'], 'string', 'max' => 36],
            [['extension'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tid' => 'Tid',
            'host' => 'Host',
            'name' => '文件名',
            'extension' => '扩展名',
            'size' => '文件大小',
            'created_at' => '上传时间',
            'updated_at' => '更新时间',
        ];
    }
}

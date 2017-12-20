<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_downloads}}".
 *
 * @property integer $id
 * @property integer $cid
 * @property string $name
 * @property string $path
 * @property string $mime
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronDownloads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_downloads}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'name', 'path'], 'required'],
            [['cid', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['path', 'mime'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => '分类ID',
            'name' => '名称',
            'path' => '路径',
            'mime' => '类型',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(FronCategory::className(), ['id' => 'cid']);
    }
}

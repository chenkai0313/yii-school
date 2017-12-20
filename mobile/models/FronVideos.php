<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_videos}}".
 *
 * @property integer $id
 * @property integer $fid
 * @property string $path
 * @property string $time
 * @property string $title
 * @property string $desc
 * @property integer $rec
 * @property integer $clicked
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronVideos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_videos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid', 'path', 'title', 'desc'], 'required'],
            [['fid', 'rec', 'clicked', 'created_at', 'updated_at'], 'integer'],
            [['path', 'title'], 'string', 'max' => 255],
            [['time'], 'string', 'max' => 8],
            [['desc'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fid' => '略缩图',
            'path' => '路径',
            'time' => '视频时长',
            'title' => '标题',
            'desc' => '简介',
            'rec' => '推荐',
            'clicked' => '点击数',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getFronFiles()
    {
        //通过子表的fid，关联主表的id字段
        return $this->hasOne(FronFiles::className(), [ 'id' => 'fid']);
    }

    public function getFronComment()
    {
        //通过子表的fid，关联主表的id字段
        return $this->hasOne(FronComment::className(), [ 'cid' => 'id']);
    }
}

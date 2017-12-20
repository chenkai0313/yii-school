<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_comment}}".
 *
 * @property string $id
 * @property string $cid
 * @property string $content
 * @property integer $review
 * @property string $created_at
 * @property string $updated_at
 */
class FronComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'content'], 'required'],
            [['cid', 'review', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => '分类id',
            'content' => '评论',
            'review' => '审核',
            'created_at' => '评论时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getFronVideos()
    {
        //通过子表的fid，关联主表的id字段
        return $this->hasOne(FronVideos::className(), [ 'id' => 'cid']);
    }

}

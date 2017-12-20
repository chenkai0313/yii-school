<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_article}}".
 *
 * @property integer $id
 * @property integer $cid
 * @property integer $fid
 * @property string $title
 * @property string $desc
 * @property string $author
 * @property string $source
 * @property integer $top
 * @property integer $rec
 * @property string $content
 * @property integer $clicked
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'fid', 'title'], 'required'],
            [['cid', 'fid', 'top', 'rec', 'clicked', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 1024],
            [['author', 'source'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => '所属分类',
            'fid' => '封面图片',
            'title' => '文章标题',
            'desc' => '简介',
            'author' => '作者',
            'source' => '来源',
            'top' => '顶置',
            'rec' => '推荐',
            'content' => '内容',
            'clicked' => '点击次数',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getFronCategorys()
    {
        //通过子表的cid，关联主表的id字段
        return $this->hasOne(FronCategory::className(), [ 'id' => 'cid']);
    }

    public function getFronFiles()
    {
        //通过子表的fid，关联主表的id字段
        return $this->hasOne(FronFiles::className(), [ 'id' => 'fid']);
    }

    public function getFronCompetitions()
    {
        //通过子表的aid，关联主表的id字段
        return $this->hasOne(FronCompetition::className(), [ 'aid' => 'id']);
    }

    public function getFronActivitys()
    {
        //通过子表的aid，关联主表的id字段
        return $this->hasOne(FronActivity::className(), [ 'aid' => 'id']);
    }

    public function getFronCompetitionJoins()
    {
        //通过子表的aid，关联主表的id字段
        return $this->hasOne(FronCompetitionJoin::className(), [ 'aid' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(FronCategory::className(), ['id' => 'cid']);
    }

    public function getFronOrganizes()
    {
        //通过子表的aid，关联主表的id字段
        return $this->hasOne(FronOrganize::className(), [ 'aid' => 'id']);
    }

    public function getFronCompetitionAssortTag()
    {
        //通过子表的aid，关联主表的id字段
        return $this->hasOne(FronCompetitionAssortTags::className(), [ 'aid' => 'id']);
    }

}
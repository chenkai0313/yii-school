<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_banner}}".
 *
 * @property integer $id
 * @property integer $tid
 * @property integer $fid
 * @property integer $sort
 * @property string $url
 * @property string $desc
 * @property integer $created_at
 */
class FronBanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_banner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid', 'fid', 'sort', 'created_at'], 'required'],
            [['tid', 'fid', 'sort', 'created_at'], 'integer'],
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
            'id' => 'ID',
            'tid' => '横幅分类',
            'fid' => '横幅图片',
            'sort' => '排序',
            'url' => '链接',
            'desc' => '简介',
            'created_at' => '创建时间',
        ];
    }

    public function getCategorys()
    {
        return $this->hasOne(FronCategory::className(), ['id' => 'id']);
    }

    public function getFronArticles()
    {
        return $this->hasOne(FronArticle::className(), ['id' => 'tid']);
    }

    public function getFronFiles()
    {
        return $this->hasOne(FronFiles::className(), ['id' => 'fid']);
    }

    public function getRgtCategorys()
    {
        return $this->hasOne(FronCategory::className(), ['rgt' => 'tid']);
    }
}

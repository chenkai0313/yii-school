<?php

namespace backend\modules\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\modules\files\models\FronFiles;
use backend\modules\cms\models\FronCategory;

/**
 * This is the model class for table "fron_article".
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
     * @return array
     */

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
        return 'fron_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'fid', 'title'], 'required'],
            [['cid', 'fid', 'top', 'rec', 'clicked'], 'integer'],
            [['created_at'],'date', 'timestampAttribute' => 'created_at', 'format' => 'php:Y-m-d H:i:s'],
            [['created_at','updated_at'],'filter','filter' => function($value){
                return is_numeric($value) ? $value : strtotime($value);
            },'skipOnEmpty' => false],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 1024],
            [['tag','author', 'source'], 'string', 'max' => 32],
            [['clicked'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cid' => Yii::t('app', 'Cid'),
            'fid' => Yii::t('app', 'Fid cover'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'tag' => Yii::t('app', 'Tag'),
            'author' => Yii::t('app', 'Author'),
            'source' => Yii::t('app', 'Source'),
            'top' => Yii::t('app', 'Top'),
            'rec' => Yii::t('app', 'Rec'),
            'content' => Yii::t('app', 'Content'),
            'clicked' => Yii::t('app', 'Clicked'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getFiles()
    {
        return $this->hasOne(FronFiles::className(), ['id' => 'fid']);
    }

    public function getCategory()
    {
        return $this->hasOne(FronCategory::className(), ['id' => 'cid']);
    }

    public function getCompetition()
    {
        return $this->hasOne(FronCompetition::className(), ['aid' => 'id']);
    }
}
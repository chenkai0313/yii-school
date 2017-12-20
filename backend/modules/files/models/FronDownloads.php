<?php

namespace backend\modules\files\models;

use Yii;
use backend\modules\cms\models\FronCategory;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fron_downloads".
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
        return 'fron_downloads';
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
            'id' => Yii::t('app', 'ID'),
            'cid' => Yii::t('app', 'Cid'),
            'name' => Yii::t('app', 'Name'),
            'path' => Yii::t('app', 'Path'),
            'mime' => Yii::t('app', 'Mime'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(FronCategory::className(),['id' => 'cid']);
    }

    public function getCategoryName()
    {
        return FronCategory::findOne($this->getParentCategory()[0]);
    }

    protected function getParentCategory()
    {
        return ArrayHelper::getColumn(FronCategory::findOne($this->cid)->parents(1)->asArray()->all(),'id');
    }

}

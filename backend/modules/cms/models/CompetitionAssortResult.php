<?php

namespace backend\modules\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "fron_competition_assort_result".
 *
 * @property integer $id
 * @property integer $tid
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class CompetitionAssortResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_competition_assort_result';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid', 'title'], 'required'],
            [['tid', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tid' => Yii::t('app', 'Tid'),
            'title' => Yii::t('app', 'Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getTags()
    {
        return $this->hasOne(CompetitionAssortTags::className(),['id' => 'tid']);
    }

}

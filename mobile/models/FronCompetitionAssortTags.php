<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_competition_assort_tags}}".
 *
 * @property integer $id
 * @property integer $aid
 * @property string $tag
 * @property integer $sort
 *
 * @property FronCompetitionAssortResult[] $fronCompetitionAssortResults
 */
class FronCompetitionAssortTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_competition_assort_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'tag'], 'required'],
            [['aid', 'sort'], 'integer'],
            [['tag'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aid' => 'article',
            'tag' => '标签',
            'sort' => '排序',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFronCompetitionAssortResults()
    {
        return $this->hasMany(FronCompetitionAssortResult::className(), ['tid' => 'id']);
    }
}

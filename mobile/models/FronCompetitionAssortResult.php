<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_competition_assort_result}}".
 *
 * @property integer $id
 * @property integer $tid
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property FronCompetitionAssortTags $t
 */
class FronCompetitionAssortResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_competition_assort_result}}';
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
            [['tid'], 'exist', 'skipOnError' => true, 'targetClass' => FronCompetitionAssortTags::className(), 'targetAttribute' => ['tid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tid' => 'tag id',
            'title' => '标题',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasOne(FronCompetitionAssortTags::className(), ['id' => 'tid']);
    }
}

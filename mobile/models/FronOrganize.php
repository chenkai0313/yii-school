<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_organize}}".
 *
 * @property integer $aid
 * @property string $culture
 * @property string $departments
 * @property string $activity
 */
class FronOrganize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_organize}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid'], 'required'],
            [['aid'], 'integer'],
            [['culture', 'departments', 'activity'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => '文章ID',
            'culture' => '组织文化',
            'departments' => '部门构成',
            'activity' => '精品活动',
        ];
    }
}

<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_competition_join}}".
 *
 * @property integer $aid
 * @property string $reg
 * @property string $reg_adds
 * @property integer $reg_time
 * @property string $act_adds
 * @property integer $act_time
 * @property string $reg_url
 */
class FronCompetitionJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_competition_join}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid'], 'required'],
            [['aid', 'reg_time', 'act_time'], 'integer'],
            [['reg', 'reg_adds', 'act_adds', 'reg_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => '文章ID',
            'reg' => '报名方式',
            'reg_adds' => '领票地点',
            'reg_time' => '领票时间',
            'act_adds' => '活动地点',
            'act_time' => '活动时间',
            'reg_url' => '报名链接',
        ];
    }

    public function getFronCompetitionJoins()
    {
        //通过子表的aid，关联主表的id字段
        return $this->hasOne(FronCompetitionJoin::className(), [ 'aid' => 'id']);
    }
}

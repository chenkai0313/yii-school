<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "fron_competition".
 *
 * @property integer $aid
 * @property integer $str_time
 * @property integer $end_time
 * @property integer $status
 */
class FronCompetition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_competition}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'str_time', 'end_time'], 'required'],
            [['aid', 'str_time', 'end_time', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => '文章ID',
            'str_time' => '开始时间',
            'end_time' => '结束时间',
            'status' => '状态0：正在进行 1：已经结束',
        ];
    }
}

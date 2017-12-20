<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_activity}}".
 *
 * @property integer $aid
 * @property string $address
 * @property string $time
 * @property string $remark
 */
class FronActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'address', 'time'], 'required'],
            [['aid'], 'integer'],
            [['address', 'time', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => '文章ID',
            'address' => '活动地址',
            'time' => '活动时间',
            'remark' => '备注',
        ];
    }


    public function getFronActivitys()
    {
        //通过子表的aid，关联主表的id字段
        return $this->hasOne(FronActivity::className(), [ 'aid' => 'id']);
    }
}

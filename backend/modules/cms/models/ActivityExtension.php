<?php

/**
 * Created by getpu on 16/9/23.
 */
 
namespace backend\modules\cms\models;

use Yii;
use yii\db\ActiveRecord;

class ActivityExtension extends ActiveRecord
{
    public static function tableName()
    {
        return 'fron_activity';
    }

    public function rules()
    {
        return [
            [['aid','address','time'], 'required'],
            [['aid'], 'integer'],
            [['address','time','remark'],'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'address' => Yii::t('app', 'Activity Address'),
            'time' => Yii::t('app', 'Activity Time'),
            'remark'   => Yii::t('app', 'Remark'),
        ];
    }
}
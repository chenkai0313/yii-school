<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

use Yii;

class OrganizeExtension extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'fron_organize';
    }

    public function rules()
    {
        return [
          [['aid'],'required'],
          [['aid'], 'integer'],
          [['culture','departments','activity'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'culture' => Yii::t('app', 'Culture'),
            'departments' => Yii::t('app', 'Departments'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }

}
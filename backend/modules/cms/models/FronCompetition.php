<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "fron_competition".
 *
 * @property integer $aid
 * @property integer $str_time
 * @property integer $end_time
 * @property integer $status
 *
 * @property FronArticle $a
 */
class FronCompetition extends \yii\db\ActiveRecord
{
    public static $cid = 9;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_competition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['str_time', 'end_time'], 'required'],
            [['str_time', 'end_time'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['str_time', 'end_time'], 'filter', 'filter' => function($value){
                   return is_numeric($value) ? $value : strtotime($value);
            }, 'skipOnEmpty' => false],
            [['aid', 'status'], 'integer'],
            [['aid'], 'exist', 'skipOnError' => true, 'targetClass' => FronArticle::className(), 'targetAttribute' => ['aid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => Yii::t('app', 'Aid'),
            'str_time' => Yii::t('app', 'Start time'),
            'end_time' => Yii::t('app', 'End time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(FronArticle::className(), ['id' => 'aid']);
    }


}

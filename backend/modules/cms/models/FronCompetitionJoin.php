<?php

namespace backend\modules\cms\models;

use Yii;

/**
 * This is the model class for table "fron_competition_join".
 *
 * @property integer $id
 * @property integer $aid
 * @property string $reg
 * @property string $reg_adds
 * @property integer $reg_time
 * @property string $act_adds
 * @property integer $act_time
 * @property string $reg_url
 *
 * @property FronArticle $a
 */
class FronCompetitionJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_competition_join';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid'], 'required'],
            [['aid'], 'integer'],
            [['reg_time', 'act_time'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['reg_time','act_time'],'filter','filter' => function($value){
                return is_numeric($value) ? $value : strtotime($value);
            },'skipOnEmpty' => false],
            [['reg', 'reg_adds', 'act_adds', 'reg_url'], 'string', 'max' => 255],
            [['aid'], 'exist', 'skipOnError' => true, 'targetClass' => FronArticle::className(), 'targetAttribute' => ['aid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'aid' => Yii::t('app', 'Aid'),
            'reg' => Yii::t('app', 'CompetitionJoin Reg'),
            'reg_adds' => Yii::t('app', 'CompetitionJoin Reg adds'),
            'reg_time' => Yii::t('app', 'CompetitionJoin Reg time'),
            'act_adds' => Yii::t('app', 'CompetitionJoin Act adds'),
            'act_time' => Yii::t('app', 'CompetitionJoin Act time'),
            'reg_url' => Yii::t('app', 'CompetitionJoin Reg url'),
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

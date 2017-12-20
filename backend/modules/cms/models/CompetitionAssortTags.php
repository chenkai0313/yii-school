<?php

/**
 * Created by getpu on 16/9/6.
 */

namespace backend\modules\cms\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class CompetitionAssortTags extends ActiveRecord
{
    public static function tableName()
    {
        return 'fron_competition_assort_tags';
    }

    public function rules()
    {
        return [
            [['id', 'aid', 'sort'], 'integer'],
            [['aid','tag'],'required'],
            [['tag'], 'string', 'max' => 32],
            [['tag'], 'checkExists']
        ];
    }

    public function attributeLabels()
    {
        return [
            'aid' => Yii::t('app', 'Competition assort aid'),
            'tag' => Yii::t('app','Tag'),
            'sort'=> Yii::t('app','Sort'),
        ];
    }

    public function checkExists($attribute)
    {
        $model = self::find()->where('aid = :aid and tag = :tag',[':aid' => $this->aid,':tag' => $this->tag])->one();
        Yii::info($model,'test');
        if($model){
            $this->addError($attribute, Yii::t('app','This tag is existed'));
        }
    }

    public function getData($aid)
    {
        return self::find()->where('aid = :aid',[':aid' => $aid])->all();
    }

    public function getA()
    {
        return $this->hasOne(FronArticle::className(),['id' => 'aid']);
    }

    public function getR()
    {
        return $this->hasMany(CompetitionAssortResult::className(),['tid' => 'id']);
    }
}
<?php

/**
 * Created by getpu on 16/9/6.
 */
 
namespace backend\modules\cms\models;

class Organize extends FronArticle
{
    public static $cid = 42;

    public function init()
    {
        $this->cid = self::$cid;
        parent::init();
    }

    public function rules()
    {
        return array_merge(parent::rules(),[
           [['desc'],'required'],
        ]);
    }

    public function getExten()
    {
        return $this->hasOne(OrganizeExtension::className(),['aid' => 'id']);
    }

    public function getJoin()
    {
        return $this->hasOne(FronCompetitionJoin::className(), ['aid' => 'id']);
    }
}
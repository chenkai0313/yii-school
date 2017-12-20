<?php

/**
 * Created by getpu on 16/9/4.
 */

namespace backend\modules\cms\models;

use Yii;

class FronCompetitionForm extends \yii\base\Model
{

    private $_article;
    private $_competition;

    public function rules()
    {
        return [
            [['FronArticle'], 'required'],
            [['FronCompetition'], 'safe'],
        ];
    }

    public function afterValidate()
    {
        $error = false;
        if (!$this->fronArticle->validate()) {
            $error = true;
        }

        if (!$this->fronCompetition->validate()) {
            $error = true;
        }
        if ($error) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->fronArticle->save()) {
            $transaction->rollBack();
            return false;
        }
        $this->fronCompetition->aid = $this->fronArticle->id;
        if (!$this->fronCompetition->save(false)) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }

    public function getFronArticle()
    {
        return $this->_article;
    }

    public function setFronArticle($FronArticle)
    {
        if ($FronArticle instanceof FronArticle) {
            $this->_article = $FronArticle;
        } else if (is_array($FronArticle)) {
            $this->_article->setAttributes($FronArticle);
        }
    }

    public function getFronCompetition()
    {
        if ($this->_competition === null) {
            if ($this->fronArticle->isNewRecord) {
                $this->_competition = new FronCompetition;
                $this->_competition->loadDefaultValues();
            } else {
                $this->_competition = $this->fronArticle->competition;
            }
        }
        return $this->_competition;
    }

    public function setFronCompetition($FronCompetition)
    {
        if (is_array($FronCompetition)) {
            $this->fronCompetition->setAttributes($FronCompetition);
        } elseif ($FronCompetition instanceof FronCompetition) {
            $this->_competition = $FronCompetition;
        }
    }

}
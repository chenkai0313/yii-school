<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronCompetition */

$this->title = Yii::t('app', 'Update Fron Competition');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Competitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Fron Competition');
?>
<div class="fron-competition-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

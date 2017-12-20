<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronCompetition */

$this->title = Yii::t('app', 'Create Fron Competition');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Competitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-competition-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

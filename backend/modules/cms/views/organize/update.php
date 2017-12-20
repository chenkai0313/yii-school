<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronCompetition */

$this->title = Yii::t('app', 'Update Organize');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organize'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Organize');
?>
<div class="fron-competition-update">

    <?= $this->render('_form', [
        'model' => $model,
        'exten' => $exten,
        'join'  => $join,
    ]) ?>

</div>

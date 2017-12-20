<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronCompetition */

$this->title = Yii::t('app', 'Create Organize');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organize'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-competition-create">

    <?= $this->render('_form', [
        'model' => $model,
        'exten' => $exten,
        'join'  => $join,
    ]) ?>

</div>

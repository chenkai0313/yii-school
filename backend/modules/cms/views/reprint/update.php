<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronReprint */

$this->title = Yii::t('app', 'Update Fron Reprint');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Reprint'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Fron Reprint');
?>
<div class="fron-reprint-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

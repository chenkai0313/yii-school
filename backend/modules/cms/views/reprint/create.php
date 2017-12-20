<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronReprint */

$this->title = Yii::t('app', 'Create Fron Reprint');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Reprint'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-reprint-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

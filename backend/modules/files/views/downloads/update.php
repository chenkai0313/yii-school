<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\files\models\FronDownloads */

$this->title = Yii::t('app', 'Update Fron Downloads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Downloads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Fron Downloads');
?>
<div class="fron-downloads-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

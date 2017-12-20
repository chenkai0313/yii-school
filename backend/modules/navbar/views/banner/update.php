<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\navbar\models\FronBanner */

$this->title = Yii::t('app', 'Update Fron Banner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fron-banner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\navbar\models\FronBanner */

$this->title = Yii::t('app', 'Create Fron Banner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-banner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>



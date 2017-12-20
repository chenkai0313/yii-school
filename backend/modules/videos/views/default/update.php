<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\videos\models\FronVideos */

$this->title = Yii::t('app', 'Update Fron Video');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fron-videos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

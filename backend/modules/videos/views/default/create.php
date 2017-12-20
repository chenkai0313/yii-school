<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\videos\models\FronVideos */

$this->title = Yii::t('app', 'Create Fron Video');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-videos-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

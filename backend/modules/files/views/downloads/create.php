<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\files\models\FronDownloads */

$this->title = Yii::t('app', 'Create Fron Downloads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Downloads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-downloads-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

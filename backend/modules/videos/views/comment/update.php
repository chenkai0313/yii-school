<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\videos\models\FronComment */

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fron-comment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

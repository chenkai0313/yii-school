<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\videos\models\FronComment */

$this->title = Yii::t('app', 'Create Fron Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

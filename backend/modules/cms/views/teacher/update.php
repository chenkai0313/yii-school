<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronTeacher */

$this->title = Yii::t('app', 'Update Teacher');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Teacher');
?>
<div class="fron-teacher-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

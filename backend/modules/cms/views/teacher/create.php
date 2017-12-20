<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronTeacher */

$this->title = Yii::t('app', 'Create Fron Teacher');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-teacher-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

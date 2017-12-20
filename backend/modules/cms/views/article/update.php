<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronArticle */

$this->title = Yii::t('app', 'Update Fron Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Article All'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Fron Article');
?>
<div class="fron-article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

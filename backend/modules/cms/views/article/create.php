<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\FronArticle */

$this->title = Yii::t('app', 'Create Fron Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fron Article All'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-article-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

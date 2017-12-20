<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app','Create Fron Article');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Z Space'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-news-create">

    <?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>

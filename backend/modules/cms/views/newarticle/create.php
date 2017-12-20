<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app','Create New Article');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','New Article'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-news-create">

    <?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>

<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app', 'Update New Article');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Z space'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-news-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


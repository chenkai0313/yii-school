<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app', 'Update Investment');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Investment'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-news-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


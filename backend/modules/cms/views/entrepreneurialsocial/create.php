<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app','Create Entrepreneurial Social');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Entrepreneurial Social'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-entrepreneurialpioneer-create">

    <?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>

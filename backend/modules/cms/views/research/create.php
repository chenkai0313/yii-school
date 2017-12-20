<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app','Create Research');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Research'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-research-create">

    <?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>

<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app', 'Update Research');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Research'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-research-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


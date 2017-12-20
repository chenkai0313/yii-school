<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app', 'Update Competition result');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Competition result'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-entrepreneurialpioneer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


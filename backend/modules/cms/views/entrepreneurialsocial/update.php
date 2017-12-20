<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app', 'Update Entrepreneurial Social');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', Yii::t('app', 'Entrepreneurial Social')), 'url' => ['index']],
    ['label' => $this->title],
];
?>

<div class="fron-entrepreneurialpioneer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


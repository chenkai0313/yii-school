<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app', 'Update Entrepreneurial Recruitment');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Entrepreneurial Recruitment'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-entrepreneurialpioneer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


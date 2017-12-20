<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app','Create Notice');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Notices'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-news-create">

    <?= $this->render('_form', [
    'model' => $model,
]) ?>

</div>

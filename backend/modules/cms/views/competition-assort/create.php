<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app','Create Competition assort');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app','Create Competition assort'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-news-create">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>

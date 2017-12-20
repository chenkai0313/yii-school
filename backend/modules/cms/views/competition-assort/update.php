<?php

/**
 * Created by getpu on 16/9/6.
 */

$this->title = Yii::t('app', 'Update Competition assort');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Update Competition assort'), 'url' => ['index']],
    ['label' => $this->title],
];

?>

<div class="fron-news-update">

    <?= $this->render('_form', [
        'model' => $model,
        'tags' => $tags,
        'result' => $result,
        'tags_list' => $tags_list,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>


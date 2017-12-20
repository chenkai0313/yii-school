<?php

/**
 * Created by getpu on 16/9/6.
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

$this->title = Yii::t('app', 'Investment');

?>

<div class="fron-news-index">

    <?= Html::a(Yii::t('app', 'Create Investment'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

    <?php Pjax::begin() ?> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'fid',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:320px;'],
                'value' => function ($model) {
                    return '<img src="' . $model->files->host . DIRECTORY_SEPARATOR . $model->files->name . '" style="width:100%;"/>';
                }
            ],
            'title',
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:320px'],
                'value' => function ($model) {
                    return date('Y-m-d', $model->created_at);
                },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'value' => date('Y-m-d'),
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ],
                ]),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['style' => 'width:50px'],
                'template' => '{update} {delete}'
            ],
        ],
    ]) ?>
    <?php Pjax::end(); ?></div>



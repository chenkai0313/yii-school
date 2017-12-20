<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cms\models\FronTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Teachers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-teacher-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= Html::a(Yii::t('app', 'Create Fron Teacher'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'fid',
                'format' => 'raw',
             // 'headerOptions' => ['style' => 'width:100px'],
                'value' => function ($model) {
                    return '<img class="teacher-avatar" src="'.$model->files->host.DIRECTORY_SEPARATOR.$model->files->name.'"/>';
                },
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
              //'headerOptions' => ['style' => 'width:200px'],
            ],
            [
                'attribute' => 'tag',
                'format' => 'raw',
            ],

            [
                'attribute' => 'created_at',
                'format' => 'raw',
             // 'headerOptions' => ['style' => 'width:120px'],
                'value' => function($model){
                    return date('Y-m-d', $model->created_at);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['style' => 'width:50px'],
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>

<?php
$css = <<<CSS
.teacher-avatar {width:84px;height:84px;border-radius:50%;}
CSS;
$this->registerCss($css);
?>
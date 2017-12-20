<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cms\models\FronCompetitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Competitions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-competition-index">

<?= Html::a(Yii::t('app', 'Create Fron Competition'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'article.title',
            [
                'attribute' => 'str_time',
                'format' => ['date','php:Y-m-d H:i:s'],
                'headerOptions' => ['style' => 'width:220px'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'str_time',
                    'value' => date('Y-m-d',strtotime('-7 days')),
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ],
                ]),
            ],
            [
                'attribute' => 'end_time',
                'format' => ['date','php:Y-m-d H:i:s'],
                'headerOptions' => ['style' => 'width:220px'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'end_time',
                    'value' => date('Y-m-d'),
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ],
                ])
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:80px'],
                'value' => function($model){
                    return $model->status ? '<label class="label label-danger">' . Yii::t('app', 'Competition over') . '</label>'
                        : '<label class="label label-info">' . Yii::t('app', 'Competition active') . '</label>';
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'status',
                    ['0' => Yii::t('app', 'Competition active'), '1' => Yii::t('app','Competition over')],
                    ['class' => 'form-control','prompt' => '---']
                )
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'header' => '操作',
                'headerOptions' => ['style' => 'width:50px'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

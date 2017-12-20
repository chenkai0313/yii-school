<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\videos\models\FronVidesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Videos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-videos-index">

    <?= Html::a(Yii::t('app', 'Create Fron Video'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

    <?php Pjax::begin() ?><?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'fid',
                'format' => 'raw',
                'value' => function($model){
                   return '<img src="'.$model->files->host .DIRECTORY_SEPARATOR. $model->files->name.'" width="120" height="80" />';
                }
            ],
            'title',
            [
                'attribute' => 'time',
                'format' => 'raw',
            ],
             'clicked',
            [
                'attribute' => 'created_at',
                'format' => ['date','php:Y-m-d'],
                'options' => ['style' => 'width:220px'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'value' => date('Y-m-d'),
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ],
                ]),
            ],
            // 'updated_at',
            [
                'attribute' => 'rec',
                'format' => 'raw',
                'value' => function($model){
                    return $model->rec ? '<label class="label label-success">'.Yii::t('app','Yes').'</label>'
                        : '<label class="label label-info">'.Yii::t('app','No').'</label>';
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'rec',
                    ['1' => Yii::t('app', 'Yes'), '0' => Yii::t('app', 'No')],
                    ['class' => 'form-control', 'prompt' => '---']
                    ),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Operate'),
                'headerOptions' => ['style' => 'width:50px'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?><?php Pjax::end() ?>
</div>

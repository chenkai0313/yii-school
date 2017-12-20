<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cms\models\FronArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Article All');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-article-index">

    <?= Html::a(Yii::t('app', 'Create Fron Article'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:80px'],
            ],
            [
                'attribute' => 'cid',
                'value' => function ($model) {
                   return $model->category->name;
                },

                'filter' => Html::activeDropDownList($searchModel,
                    'cid',
                    ArrayHelper::map(\backend\modules\cms\models\FronCategory::findOne(2)->children()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'style' => 'padding:0px', 'prompt' => '---']
                ),
            ],
            'title',
            'author',
            'source',
            'clicked',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
                'headerOptions' => ['style' => 'width:220px'],
                'filter' => DatePicker::widget([
                    'language' => 'zh-CN',
                    'model' => $searchModel,
                    //  'size' => 'sm',
                    'attribute' => 'created_at',
                    'value' => date('Y-m-d',strtotime('-7 days')),
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ],
                ]),
            ],
            [
                'attribute' => 'top',
                'headerOptions' => ['style' => 'min-width:50px;'],
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->top ? '<label class="label label-success">' . Yii::t('app', 'Yes') . '</label>'
                        : '<label class="label label-info">' . Yii::t('app', 'No') . '</label>';
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'top',
                    ['1' => Yii::t('app', 'Yes'), '0' => Yii::t('app', 'No')],
                    ['class' => 'form-control', 'prompt' => '---']
                ),
            ],
            [
                'attribute' => 'rec',
                'headerOptions' => ['style' => 'min-width:60px;'],
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->rec ? '<label class="label label-success">' . Yii::t('app', 'Yes') . '</label>'
                        : '<label class="label label-info">' . Yii::t('app', 'No') . '</label>';
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'rec',
                    ['1' => Yii::t('app', 'Yes'), '0' => Yii::t('app', 'No')],
                    ['class' => 'form-control', 'prompt' => '---']
                ),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update} {delete}',
                'options' => ['style' => 'width:60px;'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>



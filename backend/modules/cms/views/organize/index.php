<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cms\models\FronCompetitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Organize');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-competition-index">

<?= Html::a(Yii::t('app', 'Create Organize'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:80px;'],
            ],
            'title',
            [
                'attribute' => 'created_at',
                'format' => ['date','php:Y-m-d H:i:s'],
                'headerOptions' => ['style' => 'width:220px'],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'header' => '操作',
                'headerOptions' => ['style' => 'width:50px'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

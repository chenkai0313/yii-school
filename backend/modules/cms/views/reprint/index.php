<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cms\models\FronReprintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Reprint');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-reprint-index">

    <?= Html::a(Yii::t('app', 'Create Fron Reprint'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'source',
           // 'desc',
            'url',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d'],
            ],
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['style' => 'width:50px'],
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\files\models\Qiniu;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\navbar\models\bannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-banner-index">

<?= Html::a(Yii::t('app', 'Create Fron Banner'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'fid',
                'format' => 'html',
                'value' => function($model){
                   return '<img class="grid-image" src="' .$model->files->host.DIRECTORY_SEPARATOR .$model->files->name . '" />';
                }
            ],
            [
                'attribute' => 'tid',
                'format' => 'html',
                'value' => function($model){
                  return $model->navbar->name;
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'tid',
                    \yii\helpers\ArrayHelper::map(\backend\modules\navbar\models\Navbar::findOne(['name' => '网站横幅'])->children()->all(),'id','name'),
                    ['class' => 'form-control', 'style' => 'padding:0px', 'prompt' => '--']
                ),
            ],

            'sort',
            'url',
            [
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function($model){
                   return date('Y-m-d H:i:s', $model->created_at);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update} {delete}',

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

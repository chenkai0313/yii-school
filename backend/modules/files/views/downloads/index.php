<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\modules\cms\models\Space;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\files\models\FronDownloadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Downloads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-downloads-index">

<?= Html::a(Yii::t('app', 'Create Fron Downloads'), ['create'], ['class' => 'fa fa-plus-circle btn btn-success']) ?>

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
                    return $model->categoryName->name;
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'cid',
                    ArrayHelper::map(\backend\modules\cms\models\FronCategory::findOne(Space::$cid)->children()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'style' => 'padding:0px', 'prompt' => '---']
                ),
            ],
            'name',
            'path',
            'mime',
            [
                'attribute' => 'created_at',
                'format' => ['date','php:Y-m-d H:i:s'],
            ],
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'options' => ['width' => '50px'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

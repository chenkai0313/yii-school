<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\videos\models\FronCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fron Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fron-comment-index">

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'cid',
            [
                'attribute' => 'content',
                'value' => function($model){
                   return StringHelper::truncate($model->content,32);
                }
            ],
            [
                'attribute' =>  'created_at',
                'format' => ['date','php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date','php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'review',
                'headerOptions' => ['style' => 'min-width:60px;'],
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->review ? '<label class="label label-success">' . Yii::t('app', 'Yes') . '</label>'
                        : '<label class="label label-info">' . Yii::t('app', 'No') . '</label>';
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'review',
                    ['1' => Yii::t('app', 'Yes'), '0' => Yii::t('app', 'No')],
                    ['class' => 'form-control', 'prompt' => '---']
                ),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['style' => 'width:50px'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

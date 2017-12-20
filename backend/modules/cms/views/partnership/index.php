<?php

/**
 * Created by getpu on 16/9/6.
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

$this->title = Yii::t('app','Partnership');

?>

<div class="fron-news-index">

     <?= Html::a(Yii::t('app', 'Create Partnership'),['create'],['class' => 'fa fa-plus-circle btn btn-success'])  ?>

     <?php Pjax::begin() ?> <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel'  => $searchModel,
          'columns' => [
              [
                  'attribute' => 'id',
                  'format' => 'raw',
                  'headerOptions' => ['style' => 'width:80px'],
              ],
              'title',
              'author',
              'clicked',
              [
                  'attribute' => 'created_at',
                  'format' => 'raw',
                  'headerOptions' => ['style' => 'width:220px'],
                  'value' => function($model){
                         return date('Y-m-d', $model->created_at);
                  },
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
              [
                  'attribute' => 'top',
                  'format' => 'raw',
                  'headerOptions' => ['style' => 'width:80px'],
                  'value' => function($model){
                    return $model->top ? '<label class="label label-success">' . Yii::t('app','Yes'). '</label>'
                        : '<label class="label label-info">' .Yii::t('app','No'). '</label>';
                  },
                  'filter' => Html::activeDropDownList($searchModel,
                      'top',
                      ['1' => Yii::t('app','Yes'), '0' => Yii::t('app', 'No')],
                      ['class' => 'form-control', 'prompt' => '---']
                  ),
              ],
              [
                  'attribute' => 'rec',
                  'format' => 'raw',
                  'headerOptions' => ['style' => 'width:80px'],
                  'value' => function($model){
                     return $model->rec ? '<label class="label label-success">' .Yii::t('app','Yes').'</label>'
                         : '<label class="label label-info">'.Yii::t('app','No').'</label>';
                  },
                  'filter' => Html::activeDropDownList($searchModel,
                      'rec',
                      ['1' => Yii::t('app', 'Yes'), '0' => Yii::t('app', 'No')],
                      ['class' => 'form-control','prompt' => '---']
                  ),
              ],
              [
                   'class' => 'yii\grid\ActionColumn',
                   'header' => '操作',
                   'options' => ['style' => 'width:50px'],
                   'template' => '{update} {delete}'
              ],
          ],
     ])?>
     <?php Pjax::end(); ?></div>



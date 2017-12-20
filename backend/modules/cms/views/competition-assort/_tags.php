<?php

/**
 * Created by getpu on 16/9/6.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<style>
    .multiple-items {list-style:none;padding:15px 15px 0;}
    .multiple-items li{}
    .multiple-items li label{}
    .multiple-items li a{color:#fff;}
    .multiple-items li i{position: absolute; right: 0; top: -5px; background-color: #e05a5a; width:15px; border-radius: 50%;}
    .multiple-items li i:hover{background-color:#cc1515;}
</style>

<div class="row">
    <?php Pjax::begin([
        'id' => 'pjax-tags',
        'enablePushState' => false,
    ]) ?>
    <ul class="multiple-items">
       <?php foreach($tags_list as $item) : ?>
        <li class="col-xs-2 btn btn-info btn-sm"> <?= Html::encode($item->tag) ?> <i class="fa fa-close" title="删除" data-url="<?= Url::to(['delete-tags','id' => $item->id]) ?>"></i></li>
       <?php endforeach ?>
    </ul>
    <?php Pjax::end() ?>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'assort-tags',
    'action' => Url::to(['create-tags']),
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'validateOnChange' => false,
]) ?>

<?= $form->field($model, 'aid')->hiddenInput(['value' => Yii::$app->request->getQueryParam('id')])->label(false) ?>

<?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

<?= Html::submitButton(Yii::t('app','Create'),['class' => 'btn btn-success btn-tags']) ?>

<?php ActiveForm::end() ?>

<?php
$js = <<<JS
jQuery(".btn-tags").on("click", function(){ jQuery.pjax.reload({container: "#pjax-tags"}); });
jQuery(document).on("click", ".fa-close", function(){
  var _ele = $(this), url = _ele.data('url');
  jQuery.ajax({
      type : 'post',
      url  : url,
      success:function(data){
        if(data.status){ jQuery.pjax.reload({container: "#pjax-tags"}) }
      }
  });
});
jQuery(".btn-result-refresh").on("click", function(){ jQuery.pjax.reload({container: "#pjax-result"}) });
JS;
$this->registerJs($js);
?>


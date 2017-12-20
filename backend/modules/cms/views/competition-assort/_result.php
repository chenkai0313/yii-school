<?php

/**
 * Created by getpu on 16/9/6.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use getpu\plug\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>


<?php $form = ActiveForm::begin([
    'id' => 'assort-result',
    'validationUrl' => Url::to(['create-result']),
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'validateOnChange' => false,
    'options' => ['data-pjax' => true],
]) ?>

<?php Pjax::begin(['id' => 'pjax-result', 'enablePushState' => false]) ?>
<?= $form->field($model, 'tid')->widget(Select2::className(),[
    'data' => ArrayHelper::map($tags_list, 'id', 'tag'),
    'hideSearch' => true,
]) ?>
<?php Pjax::end() ?>
<?= $form->field($model, 'title')->textInput() ?>

<?= Html::submitButton(Yii::t('app', 'Add'),['class' => 'btn btn-success btn-result']) ?>
<?= Html::button(Yii::t('app', 'Refresh'),['class' => 'btn btn-info btn-result-refresh']) ?>
<?php ActiveForm::end() ?>


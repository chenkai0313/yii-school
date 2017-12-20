<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\videos\models\FronComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fron-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cid')->textInput() ?>

    <?= $form->field($model, 'created_at')->widget(DateTimePicker::className(),[
        'language' => 'zh-CN',
        'name' => 'date_from',

        'options' => [
            'autoclose' => true,
            'value' =>  date('Y-m-d H:i:s', $model->created_at ? $model->created_at : time()),
        ],
        'clientOptions' => [
            'autoclose' => true,
            'minView' => 2,
            'format' => 'yyyy-mm-dd hh:mm:ss',
            'todayBtn' => true
        ],
    ]) ?>

    <?= $form->field($model, 'content')->textarea(['maxlength' => true, 'rows' => 6]) ?>

    <?= $form->field($model, 'review',[
        'template' => '<div class="pull-left">{input}</div><div class="pull-left">{error}</div>'
    ])->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

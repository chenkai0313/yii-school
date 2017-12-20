<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use getpu\ueditor\UEditor;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Fileupload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fileupload-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filepath')->textInput() ?>


    <?=
    $form->field($model, 'filecreate_at')->widget(DateTimePicker::className(), [
        'language' => 'zh-CN',
        'name' => 'date_from',
        'options' => [
            'autoclose' => true,
        ],
        'clientOptions' => [
            'autoclose' => true,
            'minView' => 2,
            'format' => 'yyyy-mm-dd hh:mm',
            'todayBtn' => true
        ],
    ])
    ?>


    <?=
    $form->field($model, 'create_at')->widget(DateTimePicker::className(), [
        'language' => 'zh-CN',
        'name' => 'date_from',
        'options' => [
            'autoclose' => true,
        ],
        'clientOptions' => [
            'autoclose' => true,
            'minView' => 2,
            'format' => 'yyyy-mm-dd hh:mm',
            'todayBtn' => true
        ],
    ])
    ?>




    <?= $form->field($model, 'pid')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->render('@backend/modules/files/views/file/layout') ?>

<?php
$css = <<<CSS
.panel-default .fixed{position:fixed;height:inherit;background-color:#fff;}
.files-insert {width:100%;height:220px;border:1px #d8d8d8 dashed;position:relative;overflow:hidden;}
.files-insert .btn{position:absolute;top:50%;left:50%;margin:-17px 0 0 -47px;display:inline;}
.files-insert .image-items {display:block;overflow:hidden;list-style:none;padding:0;margin:0;}
.files-insert .image-items .item {padding:15px;}
.files-insert .image-items .item img{position:relative; width:100%; height:190px;z-index:1;}
.files-insert .image-items .image-close {position:absolute;top:3px;right:3px;cursor:pointer;font-size:16px;color:#e05a5a;}
.files-insert .image-items .image-close:hover{color:#cc1515;}
.files-insert .input-items .has-error{position:absolute;top:50%;left:50%;margin:-40px 0 0 -63px;}
CSS;
$this->registerCSS($css);
?>
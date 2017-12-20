<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FileuploadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fileupload-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'filename') ?>

    <?= $form->field($model, 'filepath') ?>

    <?= $form->field($model, 'filecreate_at') ?>

    <?= $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'pid') ?>

        <?php // echo $form->field($model, 'content')  ?>

    <div class="form-group">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>

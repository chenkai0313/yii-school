<?php

/**
 * Created by getpu on 16/9/5.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>



    <fieldset>
        <legend>Product</legend>
        <?= $form->field($productForm->product, 'name')->textInput() ?>
    </fieldset>

    <fieldset>
        <legend>Parcel</legend>
        <?= $form->field($productForm->parcel, 'code')->textInput() ?>
        <?= $form->field($productForm->parcel, 'width')->textInput() ?>
        <?= $form->field($productForm->parcel, 'height')->textInput() ?>
        <?= $form->field($productForm->parcel, 'depth')->textInput() ?>
    </fieldset>

    <?= Html::submitButton('Save'); ?>
    <?php ActiveForm::end(); ?>

</div>
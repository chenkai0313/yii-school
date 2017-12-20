<?php

/*** Created by getpu on 16/8/19.*/

/**
 * @var yii\widgets\ActiveForm      $form
 * @var getpu\user\models\User   $user
 */
?>

<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>

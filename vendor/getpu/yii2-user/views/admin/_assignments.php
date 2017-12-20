<?php

/*** Created by getpu on 16/8/19.*/

use getpu\rbac\widgets\Assignments;

/**
 * @var yii\web\View                $this
 * @var getpu\user\models\User   $user
 */

?>

<?php $this->beginContent('@getpu/user/views/admin/update.php', ['user' => $user]) ?>

<?= yii\bootstrap\Alert::widget([
    'options' => [
        'class' => 'alert-info alert-dismissible',
    ],
    'body' => Yii::t('user', 'You can assign multiple roles or permissions to user by using the form below'),
]) ?>

<?= Assignments::widget(['userId' => $user->id]) ?>

<?php $this->endContent() ?>

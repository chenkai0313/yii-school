<?php

/**
 * Created by getpu on 16/8/18.
 */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>

</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $this->render('header')?>
    <?= $this->render('left')?>
    <?= $this->render('content',['content' => $content])?>
</div>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
<?php

/**
 * Created by getpu on 16/8/18.
 */

use getpu\lte\LteAsset;
use yii\helpers\Html;

LteAsset::register($this);
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
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $content ?>
</div>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>

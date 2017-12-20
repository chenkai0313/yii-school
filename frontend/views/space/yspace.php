<?php

/**
 * Created by getpu on 16/9/18.
 */

use yii\helpers\Html;

$this->title = '元空间';

?>

    <div id="wrapper">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php foreach (\frontend\models\Banner::getBanner(13) as $item) : ?>
                    <li style="background:url(<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>) center center no-repeat;"></li>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="yspace">
        <div class="left">
            <div class="left-con">
                <div class="title"><?= Html::encode($this->title) ?> : <?= !isset($model->title) ?: Html::encode($model->title)  ?></div>
                <div class="content">
                   <?= !isset($model->content) ?: \yii\helpers\HtmlPurifier::process($model->content) ?>
                </div>
            </div>

        </div>
       <?= $this->render('layout') ?>
    </div>


<?php
$js = <<<JS
    $(function(){
        $("#slider").bxSlider({
            auto:true,
            mode:"fade",
            pause:3000,
            speed:500,
            controls:false,
            autoHover:true,
        });
    });
JS;

$this->registerJsFile('/assets/js/jquery.bxslider.js', ['depends' => 'frontend\assets\AppAsset']);
$this->registerCssFile('/assets/css/jquery.bxslider.css');
$this->registerJs($js, \yii\web\View::POS_END);
?>
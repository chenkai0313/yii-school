<?php

/**
 * Created by getpu on 16/9/18.
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

    <div id="wrapper">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php foreach ($banner as $item) : ?>
                    <li style="background:url(<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>) center center no-repeat;"></li>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="yspace">
        <div class="left">
            <div class="left-con">
                <div class="title"><?= Html::encode($this->title) ?> : <?= !isset($space->title) ?: Html::encode($space->title)  ?></div>
                <div class="content">
                    <?= !isset($space->content) ?: \yii\helpers\HtmlPurifier::process($space->content) ?>
                </div>
            </div>

        </div>

<!-- //////////////////////////此处注释了“最新公告“”与“文件下载“栏目，把文件下载栏目更改成了“团队风采”栏目，并栏目内详细字段修改成了“团队logo”，并链接到每个团队的详细介绍 -->
<!--         <div class="right">
            <div class="nlist">
                <div class="nlist-title">最新公告</div>
                <ul>
                    <?php foreach($notices as $item) : ?>
                        <li>
                            <span><?= date('m-d') ?></span>
                            <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div> -->

<!-- =========================================================================================== -->
            <div class="nlist">
                <!-- <div class="nlist-title">文件下载</div> -->
                <!-- <ul>
                    <?php foreach($downloads as $item) : ?>
                        <li><a href="<?= Url::to(['space/download','cid' => $item->cid, 'id' => $item->id]) ?>"><?= Html::encode($item->name) ?></a></li>
                    <?php endforeach ?>
                </ul> -->
                
                <div class="nlist-title">团队风采</div>
                    <ul>

                                <!-- 示例 ,后台上传团队信息时需要上传团队logo-->
                        <?php foreach($notices as $item) : ?>        
                            <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>">
                                <img src="<?= $item->files->host . DIRECTORY_SEPARATOR. $item->files->name ?>" />
                            </a>
                        <?php endforeach ?>
                            <!-- </li> -->

                    </ul>
                </div>
            <!-- <div class="dload"></div> -->
        </div>

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
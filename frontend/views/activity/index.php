<?php

/**
 * Created by getpu on 16/9/21.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Activity;

?>

<div class="activity">
    <div class="new-act">
        <div class="pio">
            <div class="news news1">
                <div class="news-title">最新活动</div>
                <div class="slider multiple-items father">
                    <?php foreach ($top as $item) : ?>
                        <div>
                            <a href="<?= Url::to(['activity/detail','cid' => $item->category->id, 'id' => $item->id]) ?>">
                                <div class="news-list"><img
                                        src="<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>">
                                    <span><?= Html::encode($item->title) ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <?php foreach ($categorys as $category) : ?>
            <div class="pio">
                <div class="news news2">
                    <div class="news-title">系列活动: <?= Html::encode($category->name) ?></div>
                    <div class="slider multiple-items">
                        <?php foreach (Activity::getItems($category->id, $limit) as $item) { ?>
                            <div>
                                <a href="<?= Url::to(['activity/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>">
                                    <div class="news-list"><img
                                            src="<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>">
                                        <span><?= Html::encode($item->title) ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
</div>


<?php

$js = <<<JS

// $(document).ready(function(){ 
//   $('.father').append($('.father > div').clone());
//   console.log($('.father').eq(0));
// }) 
    $(function(){
        $("#slider").bxSlider({
            auto:false,
            mode:"fade",
            pause:3000,
            speed:500,
            controls:false,
            autoHover:true,
        });
    });
//滚动
$(function(){
    $(".news1 .multiple-items").slick({
        autoplay:false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots:false,
        arrows:true,
    });
    $(".news1 .slick-prev").text("");
    $(".news1 .slick-next").text("");
});
    
$(function(){
    $(".news2 .multiple-items").slick({
        autoplay:false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots:false,
        arrows:true,
    });
    $(".news2 .slick-prev").text("");
    $(".news2 .slick-next").text("");
});


$(function(){
    $(".news3 .multiple-items").slick({
        autoplay:false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots:false,
        arrows:true,
    });
    $(".news3 .slick-prev").text("");
    $(".news3 .slick-next").text("");
});
//滚动
JS;
$this->registerJsFile('/assets/js/jquery.bxslider.js', ['depends' => 'frontend\assets\AppAsset']);
$this->registerCssFile('/assets/css/jquery.bxslider.css');
$this->registerJs($js, \yii\web\View::POS_END);
?>

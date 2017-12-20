<?php

/**
 * Created by getpu on 16/9/8.
 */

use yii\helpers\Html;

?>


<div class="teacher">
    <div class="news">
        <div class="news-title">创业导师
            <div class="line"></div>
        </div>
        <div class="slider multiple-items">
            <?php foreach (array_chunk($dataProvider, 6, true) as $item) : ?>
                <div class="half">
                    <?php foreach($item as $val) { ?>
                    <div class="news-list">
                        <img src="<?= $val->files->host .DIRECTORY_SEPARATOR. $val->files->name ?>" alt="">
                        <div class="title"><?= Html::encode($val->title) ?></div>
                        <div class="content"><?= Html::encode($val->desc) ?></div>
                    </div>
                    <?php } ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
//滚动
$(function(){
    $(".news .multiple-items").slick({
        autoplay:false,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        dots:true,
        arrows:false,
    });
    $(".news .slick-prev").text("");
    $(".news .slick-next").text("");
});
//滚动
JS;

$this->registerJs($js,\yii\web\View::POS_END);
?>

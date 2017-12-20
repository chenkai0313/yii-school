<?php

/**
 * Created by getpu on 16/9/6.
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '创业团队';

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

    <div class="pioneer">
        <div style="max-width:1200px; margin:0 auto; min-width:1200px">
            <div class="pio">
            <div class="news">
                <div class="news-title">创业先锋</div>
                <div class="slider multiple-items">
                  <?php foreach($pioneer as $item) : ?>
                    <div>
                     <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>">
                        <div class="news-list"><img src="<?= $item->files->host.DIRECTORY_SEPARATOR. $item->files->name ?>" title="<?= $item->title ?>"></div>
                        </a>
                    </div>
                  <?php endforeach ?>
                </div>
            </div>
            </div>
		
            <div class="recruit" style="background-color:#fff">
            <div class="news-title">人才招募</div>
            <div class="content">
                <div class="slider" id="img">
                    <div class="slidermid">
                        <ul class="sliderbox">
                          <?php foreach($recruit as $item) : ?>
                            <li class="first">
                                <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a>
                            </li>
                          <?php endforeach ?>
                        </ul>
                    </div>
                    <ul class="slidertext"></ul>
                    <button class="prev" style="border:none;cursor:pointer;">上一页</button>
                    <ul class="slidernav"></ul>
                    <button class="next" style="border:none;cursor:pointer;">下一页</button>
                </div>

            </div>
            </div>
        </div>
    </div>
    <div class="group-text">
        <div class="content">
            <p>截止目前，</p>
            <p>浙大总共有<span>120</span>个创业团队，</p>
            <p>其中有<span>40</span>个团队已获得融资，</p>
            <p>融资额度总计超<span>6</span>个亿人民币，</p>
            <p>有<span>12</span>家公司已经进入B轮后阶段</p>
        </div>
    </div>
    <div class="eight-pic">
        <div class="show_list">
            <?php foreach($social as $item) : ?>
            <div class="view view-first">
            <!-- 此处为新添加的tag，详细见修改要求第3点 -->
            <?php if(isset($item->tag)) : ?>
            <div class="tag_trangle">
            <span><?= Html::encode($item->tag) ?></span>
            </div>
            <?php endif ?>
            <!--  -->
              <img src="<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>">
             <div class="mask">
                <h2><?= Html::encode($item->title) ?></h2>
                <p><?= Html::encode($item->desc) ?></p>
                <a href="<?= Url::to(['news/detail','cid' => $item->category->id, 'id' => $item->id]) ?>" class="info">进一步了解</a>
            </div>
            </div>
         <?php endforeach ?>
      </div>
    </div>
<?php

$js = <<<JS
 $(function(){
    $(".news .multiple-items").slick({
        autoplay:false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots:true,
        arrows:false,
     });
        $(".news .slick-prev").text("");
         $(".news .slick-next").text("");
    });
//创业先锋滚动
    $(function(){  
        $("#img").powerSlider({
            sliderNum:11,
            speed: 500,
            delayTime: 600000000,
        });
        //$("#text").powerSlider();
        //$("#img").powerSlider({picNum:4,handle:"hide"});
        $(".code h3 span").each(function(i){
        	$(this).click(function(){
        		$(this).addClass("active").siblings().removeClass("active");
        		$(".code pre").eq(i).show().siblings("prev").hide();
        	})
        })
    });
//人才招募
//banner
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

    $(function(){
        var tag = $(".tag_trangle").find("span");
        tag.each(function(){
            if(tag.html() == ""){
                $(this).parent().css("display","none");
            }
        })
    })
JS;
$this->registerCssFile('/assets/css/jquery.bxslider.css', ['depends' => 'frontend\assets\AppAsset']);
$this->registerCssFile('/assets/css/eight.css', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('/assets/js/power-slider-debug.js', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('/assets/js/jquery.bxslider.js', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJs($js, \yii\web\View::POS_END);
?>
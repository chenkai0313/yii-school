<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?=APP_WEB;?>css/jquery.bxslider.css" rel="stylesheet" />
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <script src="<?=APP_WEB;?>js/marquee.js"></script>
    <script src="<?=APP_WEB;?>js/jquery.bxslider.js"></script>
    <script src="<?=APP_WEB;?>js/slick.min.js"></script>
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-首页</title>
</head> 
<body>
        <?php echo $this->render('//public/header');?>
        <div class="banner">
            <ul class="bxslider" id="banner">
                <?php
                foreach ($banner as $value) {
                ?>
                    <li><img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" /></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <!--==================banner==================-->
        <div class="new_notice">
            <div class="new_notice_center">
                <div class="newul">
                    <ul class="newau">
                        <?php
                        foreach ($news as $value) {
                        ?>
                        <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>"><?=$value["title"];?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--公告栏-->
        <div class="main">
            <!-- ========================以下为“mobile_school homepage”新布局，麻烦重新配置动态，谢谢=============================== -->

                <div class="news_part">
                    <p class="title">新闻动态</p>
                    <ul>
                        <?php
                            foreach($newsIndex as $value){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>">
                            <li>
                            <div class="imgs">
                                <img src="<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>"></dt>
                            </div>
                            <div class="detail">
                                <p><?=$value['title'];?></p>
                                <span class="time"><?=date('Y.m.d H:i',$value['created_at']);?></span>
                            </div>
                            </li>
                        </a>
                        <?php }?>
                    </ul>
                    <div class="link">
                        <a href="<?php echo \yii\helpers\Url::toRoute(['news/index']);?>" class="more_detail">更多动态...</a>
                    </div>
                        <!-- ==========此处点击进入“nav”的新闻动态页面-->
                </div>

                <!-- =============="最新公告"，此板块为此次新增页面，“最新公告”页面-->
                <div class="new_Notice">
                    <p class="title">通知公告</p>
                    <ul>
                        <?php
                        foreach($noticeIndex as $value){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['policy/detail','id'=>$value["id"],]);?>">
                            <li>
                            <div class="list">
                                <span class="time"><?=date('Y.m.d H:i',$value['created_at']);?></span>
                                <p><?=$value['title'];?></p>
                            </div>
                            </li>
                        </a>
                        <?php }?>
                    </ul>
                    <div class="link">
                        <a href="<?php echo \yii\helpers\Url::toRoute(['policy/total_notice']);?>" class="more_detail">更多公告...</a>
                    </div>
                        <!-- ==========此处点击进入"最新公告"页面-->
                </div>

                <!-- =============="伙伴消息"，此板块为此次新增页面，“合作伙伴”页面，只显示3个，并且是显示最的三个，静态页面-->
                <div class="n_partner">
                    <p class="title">伙伴消息</p>
                    <ul>
                        <?php
                        foreach($partnerIndex as $value){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>">
                            <li>
                            <div class="list">
                                <span class="time"><?=date('Y.m.d H:i',$value['created_at']);?></span>
                                <p><?=$value['title'];?></p>
                            </div>
                            </li>
                        </a>
                        <?php }?>
                    </ul>                 
                </div>

                <!-- =============="创业大赛"，点击此板块的“更多赛事”，链接到原有的“创业大赛”页面，原有的创业大赛更改为“创业赛事”，具体后续会说明-->
                <div class="competition_prat overflow">
                    <p class="title">创业大赛</p>
                    <ul>
                        <?php
                        foreach($matchIndex as $value){
                        ?>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>">
                            <li>
                            <div class="imgs">
                                <img src="<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>" alt="">
                            </div>
                            <div class="detail">
                                <p><?=$value['title'];?></p>
                                <span class="time"><?=date('Y.m.d H:i',$value['created_at']);?></span>
                            </div>
                            </li>
                        </a>
                        <?php }?>
                    </ul>
                    <div class="link">
                        <a href="<?php echo \yii\helpers\Url::toRoute(['news/venture_competition']);?>" class="more_detail">更多赛事...</a>
                    </div>
                </div>
        </div>

    <?php echo $this->render('//public/footer');?>
</body>
</html>

<script type="text/javascript">
    //banner
    $(function() {
        $("#banner").bxSlider({
            auto: false,
            mode: "horizontal",
            pause: 2500,
            speed: 500,
            controls: false,
            autoHover: true,
        });
    });
    //在线课程
    // $(function() {
    //     $("#class").bxSlider({
    //         auto: false,
    //         mode: "horizontal",
    //         pause: 2500,
    //         speed: 500,
    //         controls: false,
    //         autoHover: true,
    //         minSlides: 2,
    //         maxSlides: 3,
    //         slideWidth: 140,
    //         pager: false,

    //     });
    // });
    //创业空间
    $(function() {
        $("#cykj").bxSlider({
            auto: true,
            mode: "fade",
            pause: 2500,
            speed: 500,
            controls: false,
            autoHover: true,
            pager: false,

        });
    });
    //公告
    $(function() {
        $(".newul").marquee({
            showNum: 1,
            stepLen: 1,
            type: 'vertical',

        });
    });


    $(function() {
        $(".lesson-content .multiple-items").slick({
            autoplay: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: false,
            arrows: false
        });
        $(".lesson-content .slick-prev").text("");
        $(".lesson-content .slick-next").text("");
    }); //主页课程轮播

    $(".cykj .fade").slick({
        fade: true,
        autoplay: true,
        infinite: true,
        dots: false,
        arrows: false

    });

	$(".new_notice li a").height($(".new_notice .li").height());

    $(function(){
            $('.banner .bx-pager').css("display","none")
    })
</script>
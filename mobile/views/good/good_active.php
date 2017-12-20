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
    <script src="<?=APP_WEB;?>js/jquery.bxslider.js"></script>
    <script src="<?=APP_WEB;?>js/slick.min.js"></script>
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-精品活动</title>

</head>

<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="good-active">
    <div class="banner">
        <ul class="bxslider" id="banner">
            <?php
            foreach ($new as $value) {
            ?>
            <li><a href="<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>"><img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" border="0" /></a></li>
            <?php
            }
            ?>              
            <?php
            foreach ($abc as $value) {
            ?>
            <li><a href="<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>"><img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" border="0" /></a></li>
            <?php
            }
            ?>            
        </ul>
    </div>
    <div class="active-three">
        <div class="active-wrap">
            <div class="title">最新活动</div>
            <div class="three">
                <ul class="bxslider" id="three1">
                    <?php
                    foreach ($new as $value) {
                    ?>
                    <li onclick="location='<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>'">
                        <img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" />
                        <p><a href="<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>"><?=$value['title'];?></a></p>
                    </li>
                    <?php
                    }
                    ?>                    
                    <?php
                    foreach ($abc as $value) {
                    ?>
                    <li onclick="location='<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>'">
                        <img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" />
                        <p><a href="<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>"><?=$value['title'];?></a></p>
                    </li>
                    <?php
                    }
                    ?>                    
                </ul>
            </div>
        </div>
        <div class="active-wrap">
            <div class="title">系列活动：总裁说</div>
            <div class="three">
                <ul class="bxslider" id="three2">
                    <?php
                    foreach ($ceo as $value) {
                    ?>
                        <li onclick="location='<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>'">
                            <img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" />
                            <p><a href="<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>"><?=$value['title'];?></a></p>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="active-wrap">
            <div class="title">系列活动：高桌晚宴</div>
            <div class="three">
                <ul class="bxslider" id="three3">
                    <?php
                    foreach ($dinner as $value) {
                        ?>
                        <li onclick="location='<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>'">
                            <img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" />
                            <p><a href="<?php echo \yii\helpers\Url::toRoute(['good/detail','id'=>$value["id"],]);?>"><?=$value['title'];?></a></p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--底部开始-->
<?php echo $this->render('//public/footer');?>
</body>

</html>
<script>
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

    //three
    $(function() {
        $("#three1").bxSlider({
            auto: false,
            mode: "horizontal",
            pause: 2500,
            speed: 500,
            controls: true,
            autoHover: true,
        });
    });
    $(function() {
        $("#three2").bxSlider({
            auto: false,
            mode: "horizontal",
            pause: 2500,
            speed: 500,
            controls: true,
            autoHover: true,
        });
    });
    $(function() {
        $("#three3").bxSlider({
            auto: false,
            mode: "horizontal",
            pause: 2500,
            speed: 500,
            controls: true,
            autoHover: true,
        });
    });
</script>
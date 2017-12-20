<!DOCTYPE html>
<html lang="en" style="height:100%">
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
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-教师科研成果转化</title>
</head>
<body style="position:relative;min-height:100%;">
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="teacher" style="padding-bottom:119px;">
    <div class="center">
        <div class="banner">
            <ul class="bxslider" id="banner">
                <?php
                foreach ($teacherBanner as $value) {
                ?>
                <li><img src="<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>" /></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="summary">
            <?php
            foreach ($teacherBanner as $value) {
            ?>
            <div class="title">
                <h3>综合简介</h3><span class="fr">0571-000001000</span></div>
            <p><?=$value['desc'];?></p>
            <?php
            }
            ?>
        </div>
        <ul class="news-bar clearfix">
            <li><a href="<?php echo \yii\helpers\Url::toRoute(['policy/teacher']);?>" class="active">最新发布</a></li>
            <li><a href="<?php echo \yii\helpers\Url::toRoute(['policy/teacher_ok']);?>">成功案例</a></li>
        </ul>

        <div class="news-list">
        <div class="news-menu clearfix" id="container">
            <ul class="scroll">
                <?php
                foreach ($teacher as $value) {
                ?>
                    <li>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>">
                            <dl class="info-list">
                                <dt><img src="<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>"></dt>
                                <dd>
                                    <div class="p-2">
                                        <div class="info-title fl"><?=mb_substr($value["title"],0,8,"utf-8");?></div>
                                        <p class="time fr"><?=date('Y/m/d',$value['created_at']);?></p>
                                        <div class="clearfix"></div>
                                        <div class="info-content">
                                            <?php
                                            if(empty($value['desc'])){
                                                echo '<p>当前没有详细内容</p>';
                                            }else{
                                                echo '<p>'.mb_substr($value['desc'],0,36,"utf-8").'...'.'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        </div>
        <div class="clearfix"></div>
        <div id="navigation" align="center">
            <?php
            $cupg = $_GET['cupg'] + 1;
            echo '<a href="'.\yii\helpers\Url::toRoute(['policy/teacher','cupg'=>$cupg]).'"></a>'
            ?>

            <!--
            此处可以是url，可以是action，要注意不是每种html都可以加，是跟当前网页有相同布局的才可以。
            另外一个重要的地方是page参数，这个一定要加在这里，它的作用是指出当前页面页码，
            没加载一次数据，page自动+1,我们可以从服务器用request拿到他然后进行后面的分页处理。
            -->
        </div>
        <?php echo $this->render('//public/footer');?>
        <script type="text/javascript" src="<?=APP_WEB;?>js/jquery.infinitescroll.js"></script>
        <script type="text/javascript">
            $(document).ready(function (){               //别忘了加这句，除非你没学Jquery
                $("#container").infinitescroll({
                    navSelector: "#navigation",     //页面分页元素--成功后自动隐藏
                    nextSelector: "#navigation a",
                    itemSelector: ".scroll" ,
                    animate: true,
                    maxPage: <?=$pageNum;?>,
                });
            });
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
        </script>
</body>
</html>
<script type="text/javascript">
$(function(){
    $('.footer').css({
        "position":"absolute",
        "bottom":"0"
    })
})
</script>
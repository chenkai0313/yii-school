<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=APP_WEB;?>css/pullToRefresh.css"/>
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-创业资讯</title>
    <style>
        .news-menu li {overflow: hidden;box-sizing: border-box;margin-bottom: 5px;padding: 9px 12px; width: 100%;}
        .news_img {
            float: left;
            width:30%;
        }
        .news_img img {width: 100%;}
        .news_con {
            float: left;
            width: 70%;
        }
        .news_con .info-title {font-size:14px; color: #4a90e2;}
        .news_con .info-content{font-size: 13px; color:#666; margin-top:5px;}
        .news_con .time{font-size: 13px; color:#999;}
    </style>
</head>
<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="news">
    <div class="center">
        <div class="banner">
            <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$newsBanner["id"],]);?>">
            <img src="<?=$newsBanner['fronFiles']['host'].'/'.$newsBanner['fronFiles']['name'];?>" alt="<?=$newsBanner['title'];?>">
            <h3><?=$newsBanner['title'];?></h3>
            </a>
        </div>
        <ul class="news-bar clearfix">
            <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/index']);?>">重点新闻</a></li>
            <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/information']);?>" class="active">创业资讯</a></li>
            <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/reprint']);?>">浙文速递</a></li>
        </ul>
        <div class="clearfix"></div>
        <div class="news-list">
            <!--must content ul-->
            <div class="news-menu" id="container">
                <ul class="scroll">
                    <?php
                    foreach ($information as $value) {
                        ?>
                        <li>
                            <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>">
                                <div class="news_img"><img src="<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>"></div>
                                <div class="news_con">
                                    <div class="p-2">
                                        <div class="info-title fl">
                                            <?=$value["title"];?>
                                        </div>
                                        <p class="fr time"><?=date('Y/m/d',$value['created_at']);?></p>
                                        <div class="clearfix"></div>
                                        <div class="info-content">
                                            <?php
                                            if(empty($value['desc'])){
                                                echo '<p>当前没有详细内容</p>';
                                            }else{
                                                echo '<p>'.$value['desc'].'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div id="navigation" align="center">
    <?php
    $cupg = $_GET['cupg'] + 1;
    echo '<a href="'.\yii\helpers\Url::toRoute(['news/information','cupg'=>$cupg]).'"></a>'
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
</script>
</body>
</html>
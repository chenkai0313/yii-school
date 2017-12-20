<!DOCTYPE html>
<html lang="en" style="height:100%">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="<?=APP_WEB;?>css/pullToRefresh.css"/>
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-投资公司</title>
</head>

<body style="position:relative; min-height:100%">
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->

<div class="invest" style="padding-bottom:140px">
    <div class="title" style="margin-top: 20px;">
        <h3>合作投资公司</h3></div>
    <div class="invest-item" id="container">
        <ul class="scroll">
            <?php
            foreach ($model as $value) {
            ?>
            <li style="margin-top: 15px;">
                <a href="javascript:;"><img src="<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>"></a>
            </li>
            <?php
            }
            ?>
        </ul>

    </div>
</div>
<div id="navigation" align="center">
    <?php
    $cupg = $_GET['cupg'] + 1;
    echo '<a href="'.\yii\helpers\Url::toRoute(['campus/invest','cupg'=>$cupg]).'"></a>'
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
<script type="text/javascript">
$(function(){
    $('.footer').css({
        "position":"absolute",
        "bottom":"-40px"
    })
})
</script>
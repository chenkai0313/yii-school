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
    <script src="<?=APP_WEB;?>js/jqPaginator.js"></script>
    <title>浙江大学创新创业学院-创业团队</title>
</head>
<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="venture-team">
    <div class="banner">
        <ul class="bxslider" id="banner">
            <?php
            foreach ($newsBanner as $value) {
                ?>
                <li><img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" /></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="clearfix"></div>
    <!--轮播结束-->
    <div class="pioneer">
        <h3>创业先锋</h3>
        <div class="pioneer-item">
            <div class="slider multiple-items">
                <?php
                foreach ($van as $value) {
                    ?>
                    <div>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>">
                            <div class="pioneer-list"><img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" alt=""></div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!--------------------------创业先锋-------------------->
    <div class="offer">
        <h3>人才招募</h3>
        <ul class="job">
            <?php
            foreach ($job as $value) {
                ?>
                <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>"><?=$value['title'];?></a></li>
                <?php
            }
            ?>
        </ul>
        <div class="pagination">
            <li class="prev"><a href="javascript:;" data-prevId="1">上一页</a></li>
            <li class="cur"><a href="javascript:;" data-curId="">当前第1页</a></li>
            <li class="next"><a href="javascript:;" data-nextId="1">下一页</a></li>
        </div>
    </div>
    <div class="result">
        <p>截止目前，</p>
        <p> 浙大总共有<a class="active">120</a>个创业团队，</p>
        <p> 其中有<a class="active">40</a>个团队已获得融资，</p>
        <p>融资额度总计超<a class="active">6个亿</a>人民币，</p>
        <p> 有<a class="active">12</a>家公司已经进入B轮后阶段</p>
    </div>
    <div class="show">
        <h3>项目展示</h3>
        <div class="project">
            <?php
            foreach ($projectShow as $value) {
                ?>
                <div class="show-menu">
                    <img src="<?=$value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>" alt="">
                    <div class="show-intro">
                        <span class=""><?=$value['title'];?></span> <a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>"><span class="offical-web">进入官网</span></a>
                        <p><?=$value['content'];?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="pagination">
            <li class="project_prev"><a href="javascript:;" data-prevId="1">上一页</a></li>
            <li class="project_cur"><a href="javascript:;" data-curId="">当前第1页</a></li>
            <li class="project_next"><a href="javascript:;" data-nextId="1">下一页</a></li>
        </div>
    </div>
</div>
<!--底部开始-->
<?php echo $this->render('//public/footer');?>
<script type="text/javascript">
    $(document).ready(function(){
        //人才招募-下一页
        $(".next").click(function(){
            var id = $(this).find('a').attr('data-nextId');
            var idInc = ++id;
            var idPrev = --id;
            var jobNum = <?=$jobNum;?>;
                $.ajax({
                    url: '?r=campus/team_ajax',
                    dataType:'json',
                    type: 'get',
                    data: {
                        id:id
                    },
                    success: function (data) {
                        $(".job").html('');
                        $(".cur").html('');
                        $(".next").html('');
                        $(".prev").html('');
                        for(i in data){
                            var result = '';
                            result += '  <li> ';
                            result += '  <a href="?r=news/detail&id='+data[i]['id']+'">'+data[i]['title']+'</a>';
                            result += '  </li>';
                            $(".job").append(result);
                        }
                        if(idInc === jobNum){
                            $(".prev").append('<a href="javascript:;" data-prevId="'+idPrev+'">上一页</a>');
                        }else{
                            $(".prev").append('<a href="javascript:;" data-prevId="'+idPrev+'">上一页</a>');
                            $(".next").append('<a href="javascript:;" data-nextId="'+idInc+'">下一页</a>');
                        }
                        $(".cur").append('<a href="javascript:;" data-curId='+idInc+'>当前第'+idInc+'页</a>');
                    }
                });
        });
        //人才招募-上一页
        $(".prev").click(function(){
            var id = $('.prev').find('a').attr('data-prevId');
            $.ajax({
                url: '?r=campus/team_ajaxprev',
                dataType:'json',
                type: 'get',
                data: {
                    id:id
                },
                success: function (data) {
                    $(".job").html('');
                    for(i in data){
                        var result = '';
                        result += '  <li> ';
                        result += '  <a href="?r=news/detail&id='+data[i]['id']+'">'+data[i]['title']+'</a>';
                        result += '  </li>';
                        $(".job").append(result);
                    }
                    if(id === '0'){
                    }else if(id === '1'){
                        $(".cur").html('');
                        $(".cur").append('<a href="javascript:;" data-curId=1>当前第1页</a>');
                        $(".next").html('');
                        $(".next").append('<a href="javascript:;" data-nextId="'+(id)+'">下一页</a>');
                        $(".prev").html('');
                    }else{
                        $(".cur").html('');
                        $(".cur").append('<a href="javascript:;" data-curId='+(id)+'>当前第'+(id)+'页</a>');
                        $(".next").html('');
                        $(".next").append('<a href="javascript:;" data-nextId="'+(id)+'">下一页</a>');
                        $(".prev").html('');
                        $(".prev").append('<a href="javascript:;" data-prevId="'+(id-1)+'">上一页</a>');
                    }
                }
            });
        });

        //项目展示-下一页
        $(".project_next").click(function(){
            var id = $(this).find('a').attr('data-nextId');
            var idInc = ++id;
            var idPrev = --id;
            var jobNum = <?=$projectNum;?>;
            $.ajax({
                url: '?r=campus/team_ajaxproject',
                dataType:'json',
                type: 'get',
                data: {
                    id:id
                },
                success: function (data) {
                    $(".project").html('');
                    $(".project_cur").html('');
                    $(".project_next").html('');
                    $(".project_prev").html('');
                    for(i in data){
                        var result = '';
                        result += '  <div class="show-menu" style="overflow:hidden;">';
                        result += '  <img src="'+data[i]["fronFiles"]["host"]+'/'+data[i]["fronFiles"]["name"]+'" />';
                        result += '  <div class="show-intro">';
                        result += '  <span>'+data[i]["title"]+'</span><a href="?r=news/detail&id='+data[i]['id']+'"><span class="offical-web">进入官网</span></a>';
                        result += '  '+data[i]["content"];
                        result += '  </div>';
                        result += '  </div>';
                        $(".project").append(result);
                    }
                    if(idInc === jobNum){
                        $(".project_prev").append('<a href="javascript:;" data-prevId="'+idPrev+'">上一页</a>');
                    }else{
                        $(".project_prev").append('<a href="javascript:;" data-prevId="'+idPrev+'">上一页</a>');
                        $(".project_next").append('<a href="javascript:;" data-nextId="'+idInc+'">下一页</a>');
                    }
                    $(".project_cur").append('<a href="javascript:;" data-curId='+idInc+'>当前第'+idInc+'页</a>');
                }
            });
        });
        //项目展示-上一页
        $(".project_prev").click(function(){
            var id = $('.project_prev').find('a').attr('data-prevId');
            $.ajax({
                url: '?r=campus/team_ajaxprojectprev',
                dataType:'json',
                type: 'get',
                data: {
                    id:id
                },
                success: function (data) {
                    $(".project").html('');
                    for(i in data){
                        var result = '';
                        result += '  <div class="show-menu">';
                        result += '  <img src="'+data[i]["fronFiles"]["host"]+'/'+data[i]["fronFiles"]["name"]+'" />';
                        result += '  <div class="show-intro">';
                        result += '  <span>'+data[i]["title"]+'</span><a href="?r=news/detail&id='+data[i]['id']+'"><span class="offical-web">进入官网</span></a>';
                        result += '  <p>'+data[i]["content"]+'</p>';
                        result += '  </div>';
                        result += '  </div>';
                        $(".project").append(result);
                    }
                    if(id === '0'){
                    }else if(id === '1'){
                        $(".project_cur").html('');
                        $(".project_cur").append('<a href="javascript:;" data-curId=1>当前第1页</a>');
                        $(".project_next").html('');
                        $(".project_next").append('<a href="javascript:;" data-nextId="'+(id)+'">下一页</a>');
                        $(".project_prev").html('');
                    }else{
                        $(".project_cur").html('');
                        $(".project_cur").append('<a href="javascript:;" data-curId='+(id)+'>当前第'+(id)+'页</a>');
                        $(".project_next").html('');
                        $(".project_next").append('<a href="javascript:;" data-nextId="'+(id)+'">下一页</a>');
                        $(".project_prev").html('');
                        $(".project_prev").append('<a href="javascript:;" data-prevId="'+(id-1)+'">上一页</a>');
                    }
                }
            });
        });
    });
</script>
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
    $(".multiple-items").slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        autoplay: false,
        arrows:false
    });
</script>
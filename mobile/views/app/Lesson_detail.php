<!DOCTYPE html>
<html lang="en" style="height:100%">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <link href="<?=APP_WEB;?>css/video-js.css" rel="stylesheet">
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <!--script src="../js/video.js"></script-->

    <title>浙江大学创新创业学院-课程详细</title>

</head>
<body style="position:relative; min-height:100%">
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="class-detail">
    <div class="center">
        <div class="video clearfix">
            <div class="video-play">
                <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="auto" poster="<?php echo $model['fronFiles']['host'].'/'.$model['fronFiles']['name'];?>" data-setup="{}">
                    <source src="<?=$model['path'];?>" type="video/mp4">
                    <source src="http://vjs.zencdn.net/v/oceans.webm" type="video/webm">
                    <source src="http://vjs.zencdn.net/v/oceans.ogv" type="video/ogg">
                </video>
                <div class="play-icons clearfix">
                    <ul class="clearfix">
                        <li class="num"><?=$model['clicked'];?></li>
                        <li class="comment">评论</li>
                        <li class="sharebtn">分享</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="video-brief">
            <div class="title">视频简介</div>
            <div class="content">
                <?=$model['desc'];?>
            </div>
        </div>
        <div class="video-comment clearfix">
            <div class="title">精彩评论</div>
            <?php
            foreach ($modelComment as $value) {
            ?>
            <div class="item clearfix">
                <div class="left"><img src="<?=APP_WEB;?>images/teacher11.png" alt=""></div>
                <div class="right">
                    <div class="name">匿名用户<span><?=date('Y/m/d',$value['created_at']);?></span></div>
                    <div class="content"><?=$value['content'];?></div>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="text-wrap clearfix">
                <input type="hidden" value="<?=$_GET['id'];?>" id="textid">
                <textarea class="comment-text"></textarea>
                <input class="comment-submit fr" id="pl" type="submit" value="提交评论">
            </div>
        </div>
    </div>
</div>
<ul class="share share-detail" id="share">
    <div class="title">分享到</div>

    <div class="bdsharebuttonbox">
        <a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
        <a href="#" class="bds_more" data-cmd="more"></a>
    </div>
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{},"image":{"viewList":["tsina","weixin","sqq","qzone"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","weixin","sqq","qzone"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

    <div class="close">取消</div>
</ul>
<!--底部开始-->
<?php echo $this->render('//public/footer');?>
<script>
    $(document).ready(function(){
        $("#pl").click(function(){
            var text = $('.comment-text').val();
            var id = $('#textid').val();
            $.ajax({
                url: '?r=app/lesson_detail_pl',
                dataType:'json',
                type: 'get',
                data: {
                    id:id,
                    text:text
                },
                success: function (data) {}
            });
            alert('评论添加成功！');
            location.replace('?r=app%2Flesson_detail&id='+id);
        });

        $(".sharebtn").on("click",function(){
            $(".share-detail").slideToggle();
        });
        $(".close").on("click",function(){
            $(".share-detail").slideToggle();
        });
        $(".comment").click(function(){
            $(".comment-text").focus();
        })
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
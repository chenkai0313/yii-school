<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-活动详情</title>
</head>

<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->

<div class="news-detail_1">
    <div class="center">
        <div class="banner">
            <img src="<?=APP_WEB;?>images/newbg.png" alt="">
            <div class="banner-back">
                <div class="text">
                    <span class="time fr"><?=date("Y-m-d H:i:s", $model['created_at']);?></span><span class="scan-record"><?=$model['clicked'];?></span>
                    <p><?=$model['title'];?></p>
                </div>
            </div>
        </div>

        <div class="article">
            <?=$model['content'];?>
        </div>
        <div class="apply">立即报名</div>
        <div class="over">(完)</div>

        <ul class="share" id="share">
            <div class="bdsharebuttonbox"><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{},"image":{"viewList":["tsina","weixin","sqq","qzone"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","weixin","sqq","qzone"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
            <!--
            <li>
                <a><img src="../images/sina-blog.png"></a>
            </li>
            <li>
                <a><img src="../images/wechat.png"></a>
            </li>
            <li>
                <a><img src="../images/friends-moments.png"></a>
            </li>
            <li>
                <a><img src="../images/qq-zone.png"></a>
            </li>
            -->
        </ul>
        <div class="clearfix"></div>
        <div class="advise-read ">
            <h3 class="title">推荐阅读</h3>
            <ul>
                <?php
                foreach ($recommend as $value) {
                    ?>
                    <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>"><?=$value["title"];?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php echo $this->render('//public/footer');?>
<!--pop-search-->
<div class="pop-search app">
    <div class="layer"></div>
    <div class="content">
        <div class="search">
            <div class="title">报名方式</div>
            <div class="srchbody">
                <p class="T_title"><span class="title">报名方式</span>: <span class="detail"><?=$model['fronCompetitionJoins']['reg'];?>456</span></p>
                <p class="T_title"><span class="title">领票地点</span>: <span class="detail"><?=$model['fronCompetitionJoins']['reg_adds'];?></span></p>
                <p class="T_title"><span class="title">领票时间</span>: <span class="detail"><?=$model['fronCompetitionJoins']['reg_time'];?>456</span></p>
                <p class="T_title"><span class="title">报名地点</span>: <span class="detail"><?=$model['fronCompetitionJoins']['act_adds'];?></span></p>
                <p class="T_title"><span class="title">报名时间</span>: <span class="detail"><?=$model['fronCompetitionJoins']['act_time'];?></span></p>
                <p class="T_title"><span class="title">报名链接</span>: <span class="detail"><?=$model['fronCompetitionJoins']['reg_url'];?></span></p>
            </div>
        </div>

    </div>
</div>
</body>

</html>


<script>
    //弹出搜索
    $(function() {
        $(".apply").on("click", function() {
            $(".pop-search").fadeIn("600");
        });
        $(".pop-search .layer").on("click", function() {
            $(".pop-search").fadeOut("600");
        });
    });
</script>
<script type="text/javascript">
    $(function(){
        $('.srchbody .detail').each(function(){
            var $index = $(this).index();
            console.log($index)
            if($(this).text() == ""){
                $(this).parent().css("display","none");
            }
        })
    })
</script>
<?php

/**
 * Created by getpu on 16/8/22.
 */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$this->title = \frontend\models\Cache::getWebconfig()['web_title'];
?>

<div style="width: 100%;margin:0 auto;    margin-top: 10px;margin-left:8.5rem;">
    <div class="banner indexbanner" id="ban" style="max-width:785px;min-width:54.5%;float: left;">
        <ul>
            <?php foreach ($banner as $k => $v) : ?>

                <li style="background:url(<?= $v->files->host . '/' . $v->files->name ?>) center center no-repeat;"></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="information" style="height:0;">
    <div class="notice" style="margin-top: -22.8rem;margin-left: 50rem;    height: 350px;position: absolute;z-index: 1000;">
        <div class="notice-title">最新公告</div>
        <a  class="notice_more" href="<?= Url::to(['notice/index']) ?>">更多...</a>
        <ul>
            <?php foreach (\frontend\models\Notice::getLayout(9) as $item) : ?>
                <li><span><?= date("m-d", $item->updated_at) ?></span><a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
</div>
<div class="information">
    <div class="news">
        <div class="news-title">动态信息<a href="<?= Url::to(['news/index']) ?>">more</a></div>
        <div class="slider multiple-items">
            <?php foreach ($dynamic as $item) : ?>
                <div>
                    <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>">
                        <div class="news-list"><img src="<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>" alt="">
                            <p class="news-listtitle"><?= Html::encode($item->title) ?></p>
                            <p class="news-content"><?= Html::encode($item->desc) ?></p>
                            <p class="news-time"><?= date('Y-m-d', $item->created_at) ?></p>
                        </div>
                    </a>

                    <!-- ///////////////////////////////此处为了实现动态信息2行,所以将上述代码复制了一份下来////////////////////////////////////// -->
                    <!--                         <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>">
                                                <div class="news-list"><img src="<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>" alt="">
                                                    <p class="news-listtitle"><?= Html::encode($item->title) ?></p>
                                                    <p class="news-content"><?= Html::encode($item->desc) ?></p>
                                                    <p class="news-time"><?= date('Y-m-d', $item->created_at) ?></p>
                                                </div>
                                            </a> -->
                </div>

            <?php endforeach; ?>
        </div>
    </div>
    <div class="notice" style="height: 565px;">
        <div class="notice-title">创业团队</div>
        <a  class="notice_more" href="<?= Url::to(['entrepreneurial/index']) ?>">更多...</a>
        <ul>
            <?php foreach ($social as $item) : ?>
                <li><span><?= date("m-d", $item->updated_at) ?></span>
                    <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>">
                        <?= Html::encode($item->title) ?></a></li>
            <?php endforeach ?>
        </ul>
    </div>

</div>

<div class="lesson">
    <div class="lesson-body">
        <div class="lesson-title">在线创业课程：实现创业的从0到1</div>
        <a class="inf_more" href="<?= Url::to(['videos/index']) ?>">更多课程...</a><!-- 此处a标签链接需要重新后台制作 -->
        <div class="slider multiple-items">
            <?php foreach ($videos as $item) : ?>
                <div>
                    <a href="<?= Url::to(['videos/detail', 'id' => $item->id]) ?>">
                        <div class="lesson-list">
                            <img src="<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>" alt="">
                            <div class="item_wp">
                                <p class="lesson-listtitle"><?= StringHelper::truncate($item->title, 10) ?><span><?= Html::encode($item->time) ?></span></p>
                                </br>
                                <p class="lesson-content">  <?= StringHelper::truncate($item->desc, 82) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <hr>
            <?php endforeach ?>
        </div>
    </div>

    <!-- 创业大赛板块为新增，此处显示原创业大赛板块字段，“更多”链接到原创业大赛页面(此处更多链接动态已经做好) -->
    <!--  <div class="old_copmetition">
          <div class="competition_title">创业大赛</div>
          <a href="<?= Url::to(['competition/index']) ?>" class="competition_more">更多...</a>
          <ul>
    <?php foreach (\frontend\models\Competition::getLayout(9) as $item) : ?>
                                                  <li><span><?= date("m-d", $item->updated_at) ?></span><a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a></li>
    <?php endforeach ?>
          </ul>
      </div>
    -->
    <div class="link">
        <ul>
            <a href="<?= Url::to(['teacher/index']) ?>"><li class="link1">创业导师<span class="icon-tag"></span></li></a>
           <a href="<?= Url::to(['investment/index']) ?>"><li class="link2">投资公司<span class="icon-tag"></span></li></a>
            <a href="<?= Url::to(['activity/index']) ?>"><li class="link3">精品活动<span class="icon-tag"></span></li></a>
            <a href="<?= Url::to(['organization/index']) ?>"><li class="link4">创业组织<span class="icon-tag"></span></li></a>
          <a href="<?= Url::to(['research/index']) ?>"><li class="link5">专利转化<span class="icon-tag"></span></li></a>
        </ul>
    </div>
</div>



<?php
$banner = <<<JS

 $(function(){


    var banner=$("#ban").unslider({
        speed: 500,     // 动画过渡的速度(毫秒),如果不需要过渡效果就设置为false
        delay: 10,    // 每张幻灯片的间隔时间(毫秒), 如果不是自动播放就设置为false
        autoplay: false,  // 是否允许自动播放
       });
    var data = banner.data("unslider");
        $("#ban").mouseover(function(){
        data.stop();
    });
    $("#ban").mouseout(function(){
        data.start();
    });
    $(".unslider-arrow").text("");
    $(".unslider").find("a").removeClass("next");
    $(".unslider").find("a").removeClass("prev");



    //动态信息滚动
    $(".news .multiple-items").slick({
        autoplay:false,
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 6,
        dots:true,
        slideShow:6,
    });
    $(".news .slick-prev").text("");
    $(".news .slick-next").text("");

    //在线创业滚动
    // $(".lesson .multiple-items").slick({
    //     autoplay:false,
    //     infinite: true,
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots:false,
    //     arrows:false
    // });

    $(".unslider-nav").find("li").css("display","none");
 });

JS;

$this->registerJs($banner, \yii\web\View::POS_END);
?>
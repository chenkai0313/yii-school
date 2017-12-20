<?php

/**
 * Created by getpu on 16/9/12.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;
 
?>

<div class="banner" id="ban">
    <ul>
       <?php foreach($banner as $item) : ?>
        <li style="background:url(<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>) center center no-repeat;"></li>
      <?php endforeach ?>
    </ul>
</div>

<!-- online -->
    <div class="online">
        <ul class="tap">
            <li class="tap1"><a href="<?= Url::to(['','Videos[s]' => 1]) ?>">最新发布</a></li>
            <li class="tap2"><a href="<?= Url::to(['','Videos[s]' => 2]) ?>">最多观看</a></li>
            <li class="tap3"><a href="<?= Url::to(['','Videos[s]' => 3]) ?>">系统推荐</a></li>
        </ul>
       <form method="get" />
        <input type="hidden" name="Videos[s]" value="<?= Yii::$app->getRequest()->getQueryParam('Videos')['s'] ?>" />
        <input type="search" class="video_search" id="video_search" name="Videos[q]" placeholder="请输入视频名称" />
        <button type="submit" class="btn_search"></button>
       </form>
        <div class="content con1">
          <?php foreach($dataProvider->getModels() as $item) : ?>
            <div class="item">
                <a href="<?= Url::to(['videos/detail','id' => $item->id]) ?>">
                    <img src="<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>" alt="">
                    <p class="tit"><?= StringHelper::truncate($item->title,12) ?><span><?= Html::encode($item->time) ?></span></p>
                    <p class="cont"><?= StringHelper::truncate($item->desc,82) ?></p>
                    <p><?= Html::encode($item->clicked) ?>观看</p>
                </a>
            </div>
          <?php endforeach ?>
        </div>
        <div id="kkpager"></div>
    </div>
<!-- end online -->


<?php
$js = <<<JS
$(function(){
    var banner=$("#ban").unslider({
        speed: 500,     // 动画过渡的速度(毫秒),如果不需要过渡效果就设置为false
        delay: 3000,    // 每张幻灯片的间隔时间(毫秒), 如果不是自动播放就设置为false
        autoplay: true  // 是否允许自动播放
    });
    var data = banner.data("unslider");
        $("#ban").mouseover(function(){
        data.stop();
    });
    $("#ban").mouseout(function(){
        data.start();
    });
    $(".unslider-arrow").text("");
    $(".unslider-nav").css("display","none");
});

//分页
function getParameter(name) {
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r!=null) return unescape(r[2]); return 1;
}

//init
$(function(){
    var totalPage = {$dataProvider->getPagination()->getPageCount()};
    var totalRecords = {$dataProvider->getTotalCount()};
    var pageNo =  getParameter('page');//
    //生成分页
    //有些参数是可选的，比如lang，若不传有默认值

    kkpager.generPageHtml({
        pno : pageNo,
        //总页码
        total : totalPage,
        //总数据条数
        totalRecords : totalRecords,
        //链接前部
        hrefFormer : 'videos',
        //链接尾部
        hrefLatter : '.html',
        getLink : function(n){
            return this.hrefFormer + this.hrefLatter + "?page="+n;
        }
        /*
        ,lang               : {
            firstPageText           : '首页',
            firstPageTipText        : '首页',
            lastPageText            : '尾页',
            lastPageTipText         : '尾页',
            prePageText             : '上一页',
            prePageTipText          : '上一页',
            nextPageText            : '下一页',
            nextPageTipText         : '下一页',
            totalPageBeforeText     : '共',
            totalPageAfterText      : '页',
            currPageBeforeText      : '当前第',
            currPageAfterText       : '页',
            totalInfoSplitStr       : '/',
            totalRecordsBeforeText  : '共',
            totalRecordsAfterText   : '条数据',
            gopageBeforeText        : '&nbsp;转到',
            gopageButtonOkText      : '确定',
            gopageAfterText         : '页',
            buttonTipBeforeText     : '第',
            buttonTipAfterText      : '页'
        }*/

        //,
        //mode : 'click',//默认值是link，可选link或者click
        //click : function(n){
        //  this.selectPage(n);
        //  return false;
        //}
    });
});
JS;
$this->registerJs($js);
$this->registerCssFile('/assets/css/kkpager_blue.css',['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('/assets/js/kkpager.min.js', ['depends' => 'frontend\assets\AppAsset']);
?>
<?php

/**
 * Created by getpu on 16/9/12.
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
$this->desc = $model->desc;

?>

    <div class="class-detail">
        <div class="spbf">
            <div class="title"><?= Html::encode($model->title) ?></div>
            <div class="bf">
                <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="1200"
                       height="550" poster="<?= $model->files->host . DIRECTORY_SEPARATOR . $model->files->name ?>"
                       data-setup="{}">
                    <source src="<?= $model->path ?>" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="spjj">
        <span class="triangle left"></span>
        <div class="title">视频简介</div>
        <span class="triangle right"></span>
        <div class="content">
            <?= Html::encode($model->desc) ?>
        </div>
        </div>
        <div class="sppl" id="w0">
            <div class="title">视频评论</div>
            <div class="comments"></div>
            <div id="Pagination" style="margin-top:30px;"></div>
            <textarea class="pltext"></textarea>
            <input class="tjpl" type="submit" value="提交评论">
        </div>
    </div>

	

<?php
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
$comment = Url::to(['videos/comments']);
$js = <<<JS

$(".tjpl").on("click", function() {
    var text = $(".pltext"), _this = $(this);
    $.ajax({
        type : 'post',
        data : {"{$csrfParam}":"{$csrfToken}","Comment":{"content": text.val(), "cid": {$model->id}}},
        success:function(data) {
           if(data.status) {
               text.val('').attr('placeholder','评论成功');
           } else {
               text.val('').attr('placeholder','评论超时');
           }
        },
    });
});

$("#Pagination").pagination({$comment_count}, { 
        prev_text: "上一页", 
        next_text: "下一页", 
        items_per_page: 3,
        link_to: 'javascript:;',
        //回调 
        callback: pageselectCallback 
});

function pageselectCallback(page) {
  $.ajax({ 
         type: "get", 
            dataType: "json", 
            url: "{$comment}", //请求的url 
            data: { "page": parseInt(page + 1), "{$csrfParam}":"{$csrfToken}","Comment":{"cid": {$model->id}}},
            success: function (req) { 
               var html = '';
               if(req.data.length > 0) {
                   for(var i = 0; i < req.data.length; i++){
                       html += '<div class="item">' +
                            '<img src="/assets/images/news.png" alt="">' +
                            '<div class="name">匿名用户<span>'+req.data[i].time+'</span></div>' +
                            '<div class="cont">'+req.data[i].content+'</div>' +
                            '</div>';   
                   }
               $(".comments").empty().append(html);     
               }              
            }
  }); 
}

JS;

$this->registerCssFile('/assets/css/video-js.css', ['depends' => \frontend\assets\AppAsset::className()]);
$this->registerCssFile('/assets/css/pagination.css', ['depends' => \frontend\assets\AppAsset::className()]);
$this->registerJsFile('/assets/js/jquery.pagination.js', ['depends' => \frontend\assets\AppAsset::className()]);
$this->registerJs($js,\yii\web\View::POS_END);
?>
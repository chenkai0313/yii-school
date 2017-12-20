<?php

/**
 * Created by getpu on 16/9/6.
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="competition">
    <div class="recc">
        <ul class="tap">
            <li class="tap1 active">全部比赛</li>
            <li class="tap2">正在进行</li>
            <li class="tap3">已经结束</li>
        </ul>
        <div class="content con1">
            <?php foreach ($data->getModels() as $item) : ?>
                <div class="item">
                    <a href="<?= Url::to(['news/detail', 'cid' => $item->article->category->id, 'id' => $item->aid]) ?>">
                        <p class="title"><?= Html::encode($item->article->title) ?></p>
                        <p class="time">报名时间：<?= date('Y-m-d', $item->str_time) ?> ～ <?= date('Y-m-d', $item->end_time) ?>
                            <span><?= $item->article->clicked ?> 浏览</span></p>
                        <img src="<?= $item->article->files->host . DIRECTORY_SEPARATOR . $item->article->files->name ?>" alt="">
                        <?php if ($item->end_time > time()) {
                            $item->status = 0;
                            $item->save(false); ?>
                            <span class="tag2"><?= \frontend\helpers\Common::residualTime($item->end_time) ?></span>
                        <?php } else {
                            $item->status = 1;
                            $item->save(false);
                        } ?>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
        <div class="content con2"></div>
        <div class="content con3"></div>
    </div>
</div>
<?php

$csrf = Yii::$app->request->csrfToken;

$js = <<<JS
    $(".tap1").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active");
        $(".tap1").css("border-right","0");
        $(".tap2").css("border-right","1px solid #d6d7d8");
        $(".con1").show();
        $(".con2").hide();
        $(".con3").hide();
    });
    $(".tap2").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active");
        $(".tap1").css("border-right","0");
        $(".tap2").css("border-right","0");
        $(".con1").hide();
        $(".con2").show();
        $(".con3").hide();
        $.ajax({
            type : 'post',
            data : {'_zju-school' : '$csrf', 'Competition':{'active': 1}},
            success:function(r){
                if(r.data.length > 0){
                    var html = '';
                    for(var i = 0; i < r.data.length; i++){
                        html += '<a href="'+ r.data[i].url +'">' +
                               '<div class="item">' + 
                               '<p class="title">'+ r.data[i].title +'</p>' +
                               '<p class="time">报名时间： '+ r.data[i].str_time +' ~ '+r.data[i].end_time+'<span>'+r.data[i].clicked+' 浏览</span></p>' +
                               '<img src="'+r.data[i].img+'" />' +
                               '<span class="tag2">'+r.data[i].residual_time+'</span>' +
                               '</div>' +
                               '</a>';   
                    }
                   $(".con2").empty().append(html); 
                }
            }
        })
    });
    $(".tap3").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active");
        $(".tap1").css("border-right","1px solid #d6d7d8");
        $(".tap2").css("border-right","0");
        $(".con1").hide();
        $(".con2").hide();
        $(".con3").show();
        $.ajax({
            type : 'post',
            data : {'_zju-school' : '$csrf', 'Competition':{'over': 1}},
            success:function(r){
                if(r.data.length > 0){
                    var html = '';
                    for(var i = 0; i < r.data.length; i++){
                        html += '<a href="'+ r.data[i].url +'">' +
                               '<div class="item">' + 
                               '<p class="title">'+ r.data[i].title +'</p>' +
                               '<p class="time">报名时间： '+ r.data[i].str_time +' ~ '+r.data[i].end_time+'<span>'+r.data[i].clicked+' 浏览</span></p>' +
                               '<img src="'+r.data[i].img+'" />' +
                               '</div>' +
                               '</a>';
                    }
                   $(".con3").empty().append(html);
                }
            }
        })
    });
JS;

$this->registerJs($js);
?>

<?php

/**
 * Created by getpu on 16/8/31.
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\models\Activity;

$this->title = $detail->title;
$this->desc = $detail->desc;

?>

<div class="notice-detail">
    <div class="detail">
        <p class="title"><?= Html::encode($detail->title) ?></p>
        <p class="time"><?= date('Y-m-d H:i:s', $detail->created_at) ?></p>
        <div class="content">
            <?= HtmlPurifier::process($detail->content) ?>
        </div>
        <div class="item" id="news_item">
            <div class='item'><div class='btn'>报名方式</div></div>
        </div>
    </div>
    <?= $this->render('layout',['rec' => $rec]) ?>
</div>
<div class="modal">
    <div class="join_sec" style="position:absolute;top:0;left: 0; height:100%;width:100%;background-color:rgba(22,22,22,0.5);z-index:1011222;display:none">
        <div class="box">
            <div class="c_ontent">
                <div class="titlee">
                    <p class="sec" style="color:#F5A623">报名方式：</p>
                    <p class="detail" style="color:#F5A623"><?= Html::encode($detail->join->reg) ?></p>
                </div>
                <div class="method">
                    <ul>
                        <li>
                            <p class="sec">领票地点</p>：
                            <p class="detail"><?= Html::encode($detail->join->reg_adds) ?></p>
                        </li>
                        <li>
                            <p class="sec">领票时间</p>：
                            <p class="detail"><?= date('Y年m月d日',$detail->join->reg_time) ?></p>
                        </li>
                        <li>
                            <p class="sec">活动地点</p>：
                            <p class="detail"><?= Html::encode($detail->join->act_adds) ?></p>
                        </li>
                        <li>
                            <p class="sec">活动时间</p>：
                            <p class="detail"><?= date('Y年m月H点',$detail->join->act_time) ?></p>
                        </li>
                        <li>
                            <p class="sec">报名链接</p>：
                            <p class="detail"><?= Html::encode($detail->join->reg_url) ?></p>
                        </li>
                        <li>
                            <p class="sec"></p>
                            <p class="detail"></p>
                        </li>
                    </ul>
                </div>
                <div class="close">close</div>
            </div>
        </div>
    </div>
</div>
<?php
$js = <<<JS
	$(function(){
		$(".item .btn").each(function(){
			$(this).bind("click",function(){
			$('.join_sec').fadeIn(200);
			$('body').addClass('body_hide')
		})
		})
		$('.close').bind("click",function(){
			$('.join_sec').fadeOut(200);
			$('body').removeClass('body_hide')	
		})
		$('.join_sec .method .detail').each(function(){
			if($(this).text() == ""){
				$(this).parent().css("display","none");
			}
		})
	})
JS;
$this->registerJs($js);
?>

<?php

/**
 * Created by getpu on 16/9/23.
 */

use yii\helpers\Html;
 
?>

<div class="organization">
  <?php foreach($items as $item) : ?>
    <div class="item">
        <div class="title"><?= Html::encode($item->title) ?></div>
        <div class="cont">
            <div class="left">
                <img src="<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>" />
                <p><?= Html::encode($item->desc) ?></p>
                <div class="btn">加入我们</div>
            </div>
            <div class="right">
                <div class="taplist">
                    <div class="tap active">组织文化</div>
                    <div class="tap">部门构成</div>
                    <div class="tap">精品活动</div>
                </div>
                <div class="con con1"><?= Html::encode($item->exten->culture) ?></div>
                <div class="con con2"><?= Html::encode($item->exten->departments) ?></div>
                <div class="con con3"><?= Html::encode($item->exten->activity) ?></div>
            </div>
        </div>
        <div class="modal">
            <div class="join_sec" style="position:absolute;top:0;left: 0; height:100%;width:100%;background-color:rgba(22,22,22,0.5);z-index:1011222;display:none">
                <div class="box">
                    <div class="c_ontent">
                        <div class="titlee">
                            <p class="sec">报名方式</p>：
                            <p class="detail"><?= Html::encode($item->join->reg) ?></p>
                        </div>
                        <div class="method">
                            <ul>
                                <li>
                                    <p class="sec">报名方式</p>：
                                    <p class="detail"><?= Html::encode($item->join->reg) ?></p>
                                </li>
                                <li>
                                    <p class="sec">报名时间</p>：
                                    <p class="detail"><?= date('Y年m月d日',$item->join->reg_time) ?></p>
                                </li>
                                <li>
                                    <p class="sec">报名地点</p>：
                                    <p class="detail"><?= Html::encode($item->join->reg_adds) ?></p>
                                </li>
                                <li>
                                    <p class="sec">报名链接</p>：
                                    <p class="detail"><?= Html::encode($item->join->reg_url) ?></p>
                                </li>
                                <li>
                                    <p class="sec">活动时间</p>：
                                    <p class="detail"><?= date('Y年m月H点',$item->join->act_time) ?></p>
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
    </div>
  <?php endforeach ?>
</div>


<?php

$js = <<<JS
    $(function() {
        var len = $(".organization").children().length;
        $(".organization").delegate(".tap", "click", function() {
            var i = $(this).index();
            $(this).addClass("active").siblings().removeClass("active");
            $(this).parent().parent().find(".con").hide();
            $(this).parent().parent().find(".con").eq(i).show();
        });

    });

  
	$(function(){
		$(".item .btn").each(function(){
			$(this).bind("click",function(){
			$(this).closest(".item").find(".join_sec").fadeIn(200);
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
	});
	
	console.log($(".item .btn").size())
	console.log($('.join_sec .method .detail').parent())

JS;

$this->registerJs($js);
?>
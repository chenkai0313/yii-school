<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = Html::encode($detail->title);

?>

<div class="competition_detail">
    <div class="detail">
        <p class="title"><?= Html::encode($detail->title) ?></p>

        <p class="time"><?= date('Y.m.d', $detail->created_at) ?> 更新</p>

        <div class="content">
            <div>
                <?= HtmlPurifier::process($detail->content) ?>
            </div>
            <div class="year">
                <p class="year_title">浙江大学历年成绩</p>

                <div class="con">
                    <ul class="first">
                        <?php foreach (ArrayHelper::index($result, 'tid') as $item) : ?>
                            <li><p class="year_list"><?= Html::encode($item->tags->tag) ?></p></li>
                        <?php endforeach ?>
                    </ul>
                    <ul class="second">
                        <?php foreach (ArrayHelper::index($result, 'id', ['tid']) as $items) : ?>
                            <li>
                                <?php foreach ($items as $i) { ?>
                                  <p class="get_detail"><?= Html::encode($i->title) ?></p>
                                <?php } ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="list">
         <div class="qrcode">

        <img src="
        <?php
        
        $id = $_GET['id'];
        
        $m1 = "http://qr.liantu.com/api.php?text=http://mobile.hz.school.youjiadv.com/index.php" . "?r=news%2Fventure_info%26id=" . $id . "";
        echo $m1;
        ?>
             " alt=""><span>微信扫一扫</br>掌上阅读</span>
    </div>
        <div class="title">热点推荐</div>
        <ul>
            <?php foreach ($rec as $item) : ?>
                <li>
                    <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

<?php
$js = <<<JS

$(function(){
    var parent = $('.first li');
    parent.click(function(){
       $(this).css({"background-color":"#004ea2","color":"#fff"
    }).siblings().css({"background-color":"#fff","color":"#004ea2" });

    var index = parent.index(this);
    $('.second li').eq(index).show().siblings().hide();
    });

    $('.second li').eq(0).show().siblings().hide();
    $('.first li').eq(0).css({"background-color":"#004ea2", "color":"#fff"});

});

JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>

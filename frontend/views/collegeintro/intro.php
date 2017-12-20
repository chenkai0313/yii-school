<?php

/**
 * Created by getpu on 16/8/31.
 */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$cache = Yii::$app->cache;
?>
<div class="notice-detail">
    <div class="detail">
        <p class="title" style="text-align: center;font-size: 29px;    border-bottom: 1px dashed #979797;    padding-bottom: 13px;">学院介绍 </p>

        <div class="content">

            <?= $cache->get('webConfig')['web_intro'] ?>
        </div>
        <div class="item" id="news_item">
        </div>
    </div>
    <div class="list">
         <div class="qrcode">

                    <img src="
                          <?php
                    $m1 = "http://qr.liantu.com/api.php?text=http://mobile.zdcx.mctag.cn/index.php" . "?r=intro%2Fdetail";
                    echo $m1;
                    ?>
                
                         " alt=" "><span>微信扫一扫</br>掌上阅读</span>
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

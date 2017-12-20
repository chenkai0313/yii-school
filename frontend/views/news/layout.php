<?php

/**
 * Created by getpu on 16/9/1.
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="list">
    <div class="qrcode">

        <img src="
        <?php
        $cid = $_GET['cid'];
        $id = $_GET['id'];
        $m1 = "http://qr.liantu.com/api.php?text=http://mobile.zdcx.mctag.cn/index.php" . "?r=news%2Fdetail%26cid=" . $cid . "%26id=" . $id . "";
        echo $m1;
        ?>
             " alt=""><span>微信扫一扫</br>掌上阅读</span>
    </div>
    <div class="title">热点推荐</div>
    <ul>
        <?php foreach ($rec as $item) : ?>
            <li><a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a></li>
        <?php endforeach ?>
    </ul>
</div>
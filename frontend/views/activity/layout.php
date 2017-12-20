<?php

/**
 * Created by getpu on 16/9/1.
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="list">
    <div class="qrcode">
        <img src="/assets/images/qrcode.png" alt=""><span>微信扫一扫</br>掌上阅读</span>
    </div>
    <div class="title">热点推荐</div>
    <ul>
       <?php foreach($rec as $item) : ?>
        <li><a href="<?= Url::to(['activity/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a></li>
       <?php endforeach ?>
    </ul>
</div>
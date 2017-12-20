<?php

/**
 * Created by getpu on 16/8/31.
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

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
        </div>
    </div>
    <?= $this->render('layout',['rec' => $rec]) ?>
</div>

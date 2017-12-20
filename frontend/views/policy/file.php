<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>

<div class="total_notice">
    <div class="rec">
        <div class="list">
            <div class="title">全部相关文件</div>
            <div class="listbody">
                <ul>
                    <?php foreach ($model as $key => $v) {
                        ?>
                        <li style="list-style-type:point;">
                            <a href="<?= $v['filepath'] ?>" download="<?= $v['filepath'] ?>" style="width:100%">
                                <p class="list_con" style="display: inline-block;"><?= $v['filename'] ?></p>
                                <span class="time"><?= $v['create_at'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div id="kkpager"></div>
            </div>
        </div>
    </div>
</div>
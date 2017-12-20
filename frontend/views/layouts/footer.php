<?php

/**
 * Created by getpu on 16/8/22.
 */
use yii\helpers\Html;
use frontend\models\Navbar;

$cache = Yii::$app->cache;
?>

<div class="footer">
    <div class="footer-body">
        <div class="list">
            <?php foreach (\frontend\models\Cache::getFooterNav() as $item) : ?>
                <dl>

                    <?php
                    $rs = Html::encode($item['label']);
                    if ($rs == '空') {
                        echo '<dt style="height: 24px;"></dt>';
                    } else {
                        echo '<dt>' . Html::encode($item['label']) . '</dt>';
                    }
                    ?>


                    <?php
                    if (!empty($item['items'])) {
                        foreach ($item['items'] as $items) {
                            ?>
                            <dd><a href="<?= Html::encode($items['abs_url']) ?>"><?= Html::encode($items['label']) ?></a></dd>
                            <?php
                        }
                    }
                    ?>
                </dl>
            <?php endforeach ?>
            <dl class="xyqc">
                <dd><a href="javascript::">学院全称：<?= Html::encode($cache->get('webConfig')['web_title']) ?></a></dd>
                <dd><a href="javascript::">学院地址：<?= Html::encode($cache->get('webConfig')['web_address']) ?></a></dd>
                <dd><a href="javascript::">办公电话：<?= Html::encode($cache->get('webConfig')['web_phone']) ?></a></dd>
                <dd><a href="javascript::">办公传真：<?= Html::encode($cache->get('webConfig')['web_fax']) ?></a></dd>
            </dl>
        </div>
        <div class="info">
            <p class="en-info"><?= Html::encode($cache->get('webConfig')['web_copyright']) ?></p>
            <p><?= Html::encode($cache->get('webConfig')['web_icp']) ?></p>
        </div>
    </div>
    <hr>
</div>
<style>
    #list_demo{
        font-size: 20px;
        width: 350px;
        height: 31px;
        line-height: 23px;
        overflow: hidden;
        /* text-align: center; */
        border-bottom: 1px dashed #d6d7d8;
        text-indent: 15px;

        padding-top: 8px;
    }
    #list_demo>a{
        color: #666;
        font-size: 15px;
        width: 72%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        display: inline-block;
    }
    #list_demo>span{
        float: inherit; 
        color: #9b9b9b;
        font-size: 13px;
        line-height: inherit;
        vertical-align: top;
    }
    .more{
        text-align: right;
    }
</style>   

<?php

/**
 * Created by getpu on 16/8/22.
 */

use yii\helpers\Url;

?>

<div class="header">
    <div class="wrap">
        <a href="/"><div class="logo"><img src="/assets/images/logo.png" alt="logo"></div></a>
        <ul class="nav" id="nav_detail">
           <?php foreach(\frontend\models\Cache::getHeaderNav() as $item) : ?><li>
                <a href="<?=Url::to($item['url'])?>"><?=$item['label']?></a>
                 <?php if(!empty($item['items'])) : ?>
                    <ul>
                        <?php foreach($item['items'] as $items) { ?>
                            <li><a href="<?=Url::to($items['url'])?>"><?=$items['label']?></a></li>
                        <?php } ?>
                    </ul>
                 <?php endif ?></li>
           <?php endforeach ?>
        </ul>
    </div>
</div>
<!-- header -->

<script type="text/javascript" src="/assets/js/nav_select.js"></script>
<script type="text/javascript">
window.onload = function(){
        nav_slect()
    }
</script>


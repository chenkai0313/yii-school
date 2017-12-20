<?php

/**
 * Created by getpu on 16/8/23.
 */

use yii\widgets\Menu;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="fa fa-info text-blue"></i>
            <span>网站信息</span>
        </div>
    </div>
    <div class="panel-body">
        <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('app', 'Web version'), 'url' => ['website/index']],
                ['label' => Yii::t('app', 'Mobile version'), 'url' => ['website/mobile']],
                ['label' => Yii::t('app', 'Qiniu version'), 'url' => ['website/qiniu']],
            ],
        ]) ?>
    </div>
</div>

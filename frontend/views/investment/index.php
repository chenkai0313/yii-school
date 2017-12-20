<?php

/**
 * Created by getpu on 16/9/21.
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '顶级合作投资机构';

?>

<div class="investment">
    <div class="title">
        顶级合作投资机构
        <div class="line"></div>
    </div>
    <div class="show">
       <?php foreach($model as $item) : ?>
        <div class="showitem">
            <a href="javascript:;" title="<?= Html::encode($item->title) ?>">
                <img src="<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name?>" />
            </a>
        </div>
       <?php endforeach ?>
    </div>
</div>


<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '创业赛事';

?>

<div class="new_competition">
    <div class="rec">
        <div class="list">
            <div class="title">赛事汇总</div>
            <div class="listbody">
                <ul>
                    <?php foreach($data->getModels() as $item) : ?>
                        <li><a href="<?= Url::to(['detail','cid' => $item->category->id, 'id' => $item->id]) ?>">
                                <img class="g_logo" src="<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>" />
                                <p class="list_con"><?= Html::encode($item->title) ?></p>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
                <div id="kkpager"></div>
            </div>
        </div>
    </div>
</div>

<?php

/**
 * Created by getpu on 16/9/1.
 */

use yii\helpers\Url;

$this->title = '缓存管理';
$this->params['breadcrumbs'] = [
    ['label' => $this->title ]
];

?>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa text-blue fa-database"></i>
                    <span>前台缓存</span>
                </div>
            </div>
            <div class="panel-body">
               <?php foreach($model->keys as $key) : ?>
                <ul>
                    <li class="col-md-11 name"><?= Yii::t('app',$key) ?></li>
                    <li class="col-md-1">
                        <a href="<?= Url::to(['delete','key' => $key]) ?>" title="删除" data-confirm="您确定要删除此项吗?" data-method="post">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </li>
                </ul>
               <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa text-blue fa-database"></i>
                    <span>后台缓存</span>
                </div>
            </div>
            <div class="panel-body"></div>
        </div>
    </div>
</div>

<?php
$css = <<<CSS
.panel-default .panel-body ul{list-style:none;}
.panel-default .panel-body ul li {padding:0;margin:0;}
CSS;

$this->registerCSS($css);
?>
<?php

/**
 * Created by getpu on 16/8/24.
 */

use getpu\tree\TreeView;
use backend\modules\setting\models\FronModule;

$this->title = '模块管理';
$this->params['breadcrumbs'] = [
    ['label' => '系统设置'],
    ['label' => $this->title],
];
?>


<?=  TreeView::widget([
    'query' => FronModule::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => '导航管理'],
    'rootOptions' => ['label'=>'<span class="text-primary">根目录</span>'],
    'treeOptions' => ['style' => 'height:550px;'],
    'fontAwesome' => true,
    'isAdmin' => true,
    'showInactive' => true,
    'allowNewRoots' => true,
    'displayValue' => 1,
    'iconEditSettings'=> [
        'show' => 'list',
        'listData' => [
            'folder' => 'Folder',
            'folder-open' => 'Folder-open',
            'file' => 'file',
        ],
    ],
    'softDelete' => false,
    'cacheSettings' => [
        'enableCache' => true
    ]
]); ?>

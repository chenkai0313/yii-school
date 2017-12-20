<?php

/**
 * Created by getpu on 16/8/24.
 */

use getpu\tree\TreeView;
use backend\modules\cms\models\FronCategory;

$this->title = 'CMS分类';
$this->params['breadcrumbs'] = [
    ['label' => 'CMS',['/cms/default']],
    ['label' => $this->title],
];

?>

<?=  TreeView::widget([
    'query' => FronCategory::findOne(1)->children(),
    'headingOptions' => ['label' => 'CMS分类管理'],
    'rootOptions' => ['label'=>'<span class="text-primary">根目录</span>'],
    'treeOptions' => ['style' => 'height:550px;'],
    'fontAwesome' => true,
    'isAdmin' => true,
    'showInactive' => true,
    'allowNewRoots' => false,
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

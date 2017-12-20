<?php

use getpu\tree\TreeView;
use getpu\tree\TreeViewInput;
use backend\modules\navbar\models\Navbar;

$this->title = '导航管理';
$this->params['breadcrumbs'][] = $this->title;

?>


<?php /* TreeViewInput::widget([
    'name' => 'dd[ind]',
    'value' => 'true', // preselected values
    'query' => Navbar::findOne(['name' => '网站导航'])->children(),
    'headingOptions' => ['label' => '分类导航'],
    'rootOptions' => ['label'=>'<i class="fa fa-tree text-success"></i>'],
    'fontAwesome' => true,
    'asDropdown' => true,
    'multiple' => false,
    'options' => ['disabled' => false],
]); */ ?>

<?=  TreeView::widget([
    'query' => Navbar::find()->addOrderBy('root, lft'),
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

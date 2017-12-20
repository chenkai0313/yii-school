<?php

/**
 * Created by getpu on 16/8/19.
 */

use getpu\mgmt\models\Tree;
use getpu\tree\TreeView;

$this->title = '所有模块';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= TreeView::widget([
    // single query fetch to render the tree
    'query'             => Tree::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => '模块管理'],
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
            'folder' => 'folder',
            'file' => 'file',
            'cog' => 'cog',
            'comments' => 'comments',
            'cube' => 'cube',
            'cubes' => 'cubes',
            'cloud' => 'cloud',
            'cloud-download' => 'cloud-download',
            'download' => 'download',
            'empire' => 'empire',
            'info' => 'info',
            'info-circle' => 'info-circle',
            'tag' => 'tag',
            'user'=> 'user',
            'user-md' => 'user-md',
            'user-plus' => 'user-plus',
            'group' => 'group',
            'gratipay' => 'gratipay',
            'minus-circle' => 'minus-circle',
            'newspaper-o' => 'newspaper-o',
            'home' => 'home',
            'flag' => 'flag',
            'flask' => 'flask',
            'file-text-o' => 'article',
            'link' => 'link',
            'trophy' => 'trophy',
            'life-ring' => 'life-ring',
            'registered' => 'registered',
            'hand-o-right' => 'into',
            'sun-o' => 'sun-o',
            'share-alt' => 'share',
            'universal-access' => 'universal-access',
            'square' => 'square',
            'square-o' => 'square-o',
            'server' => 'server',
            'shirtsinbulk' => 'shirtsinbulk',
            'spotify' => 'spotify',
            'street-view' => 'street-view',
            'sticky-note' => 'sticky-note',
            'sticky-note-o' => 'sticky-note-o',
            'thumb-tack' => 'thumb-tack',
            'thumbs-o-up' => 'thumbs-o-up',
            'thumbs-o-down' => 'thumbs-o-down',
            'file-video-o' => 'file-video-o',
            'bars' => 'bars',
            'heart'  => 'heart',
            'sign-language' => 'handle',
            'envelope' => 'envelope',
            'envelope-o' => 'envelope-o',
            'cc-visa'   => 'cc-visa',
            'product-hunt' => 'product-hunt',
            'flag-checkered' => 'flag-checkered',
            'paper-plane' => 'paper-plane',
            'picture-o'  => 'picture-o',
            'database'  => 'database',
            'sitemap'  => 'sitemap',
            'glass'   => 'glass',
            'graduation-cap' => 'graduation-cap',
            'weibo' => 'weibo',
            'video-camera' => 'video-camera',
            'volume-up' => 'volume-up',
        ],
    ],
    'softDelete' => false,
    'cacheSettings' => [
        'enableCache' => true
    ]
]); ?>

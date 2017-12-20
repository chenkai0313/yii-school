<?php

/**
 * Created by getpu on 16/8/19.
 */

namespace getpu\mgmt\models;


class Tree extends \getpu\tree\models\Tree
{
    public static function tableName()
    {
        return 'tree';
    }

    public static function makeTree($tree)
    {
        $items = [];
        foreach($tree->all() as $node){
            if(!$node->isActive()) continue;
            $items[] = [
                'label' => $node->name,
                'icon' =>  !empty($node->icon) ? 'fa fa-'.$node->icon : 'fa fa-file',
                'url'   => !empty($node->url) ? [$node->url] : 'javascript:;',
                'items' => self::makeTree($node->children(1)),
            ];
        }
        return $items;
    }
}

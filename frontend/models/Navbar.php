<?php

/**
 * Created by getpu on 16/8/24.
 * 全站导航
 */

namespace frontend\models;

use yii\base\InvalidValueException;

class Navbar extends \backend\modules\navbar\models\Navbar
{
    /**
     * @param $tree
     * @return array
     * url Url::to();
     * abs_url http://xxxx.com/xxxx
     */
    public static function makeTree($tree)
    {
        $items = [];
        foreach ($tree->all() as $node) {
            if (!$node->isActive()) continue;
            $items[] = [
                'label' => $node->name,
                'url' => !empty($node->url) ? self::getUrl($node->url) : 'javascript:;',
                'abs_url' => !empty($node->url) ? $node->url : 'javascript:;',
                'items' => self::makeTree($node->children(1)),
            ];
        }
        return $items;
    }

    /**
     * @param $str
     * @return array
     */
    public static function getUrl($str)
    {
        if (!is_string($str) && !isset($str)) {
            throw new InvalidValueException('$str must be set');
        }

        if (($pos = strpos($str, '?')) !== false) {
            $paramter = [substr($str, 0, $pos)];
            foreach (explode('&', substr($str, $pos + 1)) as $pair) {
                if (($pos1 = strpos($pair, '=')) !== false) {
                    $paramter[substr($pair, 0, $pos1)] = substr($pair, $pos1 + 1);
                }
            }
        }
        return empty($paramter) ? [$str] : $paramter;
    }

}
<?php

/**
 * Created by getpu on 16/9/19.
 */

namespace frontend\helpers;

class Common
{
    public static function residualTime($end_time)
    {
        if (!isset($end_time) && (int)$end_time) {
            return null;
        }
        $t = $end_time - time();
        return floor($t / 86400);
    }
}
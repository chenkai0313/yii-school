<?php

/**
 * Created by getpu on 16/8/19.
 */

namespace backend\assets;

use yii\web\AssetBundle;

class PluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/getpu/yii2-lte/plugins';

    public $css = [
        'fileUpload/fileinput.min.css',
    ];
    public $js = [
        'slimScroll/jquery.slimscroll.min.js',
        'fileUpload/fileinput.min.js',
        'fileUpload/canvas-to-blob.min.js',
    ];

    public $depends = [

    ];
}
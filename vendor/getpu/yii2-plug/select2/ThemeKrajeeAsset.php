<?php

/**
 * Created by getpu on 16/8/21.
 */

namespace getpu\plug\select2;

class ThemeKrajeeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/select2-krajee']);
        parent::init();
    }
}

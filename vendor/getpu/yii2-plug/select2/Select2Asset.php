<?php

/**
 * Created by getpu on 16/8/21.
 */

namespace getpu\plug\select2;


class Select2Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/select2', 'css/select2-addl']);
        $this->setupAssets('js', ['js/select2.full', 'js/select2-krajee']);
        parent::init();
    }
}

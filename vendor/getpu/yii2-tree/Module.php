<?php

/**
 * Created by getpu on 16/8/18.
 */

namespace getpu\tree;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * The tree management module for Yii Framework 2.0.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class Module extends \yii\base\Module
{
    const MODULE = 'tree';

    const NODE_MANAGE = 'manage';
    const NODE_REMOVE = 'remove';
    const NODE_MOVE = 'move';
    const NODE_SAVE = 'save';

    const VIEW_PART_1 = 1;
    const VIEW_PART_2 = 2;
    const VIEW_PART_3 = 3;
    const VIEW_PART_4 = 4;
    const VIEW_PART_5 = 5;

    /**
     * @var array the configuration of nested set attributes structure
     */
    public $treeStructure = [];

    /**
     * @var array the configuration of additional data attributes
     * for the tree
     */
    public $dataStructure = [];

    /**
     * @var string the name to identify the nested set behavior name in the
     * Tree model. Defaults to `tree`.
     */
    public $treeBehaviorName = 'tree';

    /**
     * @var array the default configuration settings for the tree view widget
     */
    public $treeViewSettings = [
        'nodeView' => '@getpu/tree/views/_form',
        'nodeAddlViews' => [
            self::VIEW_PART_1 => '',
            self::VIEW_PART_2 => '',
            self::VIEW_PART_3 => '',
            self::VIEW_PART_4 => '',
            self::VIEW_PART_5 => '',
        ]
    ];

    /**
     * @var array the list of asset bundles that would be unset when rendering
     * the node detail form via ajax
     */
    public $unsetAjaxBundles = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\widgets\ActiveFormAsset',
        'yii\validators\ValidationAsset'
    ];

    /**
     * @inherit doc
     */
    public function init()
    {
        //$this->_msgCat = 'kvtree';
        parent::init();
        $this->treeStructure += [
            'treeAttribute' => 'root',
            'leftAttribute' => 'lft',
            'rightAttribute' => 'rgt',
            'depthAttribute' => 'lvl',
        ];
        $this->dataStructure += [
            'keyAttribute' => 'id',
            'nameAttribute' => 'name',
            'urlAttribute'  => 'url',
            'iconAttribute' => 'icon',
            'iconTypeAttribute' => 'icon_type'
        ];
        $nodeActions = ArrayHelper::getValue($this->treeViewSettings, 'nodeActions', []);
        $nodeActions += [
            self::NODE_MANAGE => Url::to(['/tree/node/manage']),
            self::NODE_SAVE => Url::to(['/tree/node/save']),
            self::NODE_REMOVE => Url::to(['/tree/node/remove']),
            self::NODE_MOVE => Url::to(['/tree/node/move']),
        ];
        $this->treeViewSettings['nodeActions'] = $nodeActions;

        Yii::$app->i18n->translations['tree*'] = [
            'class' => '\yii\i18n\PhpMessageSource',
            'basePath' => '@getpu/tree/messages',
          //  'sourceLanguage' => 'zh-CN',
            'forceTranslation' => true,
            'fileMap' => [
                'main' => 'tree.php',
            ],
        ];
    }
}

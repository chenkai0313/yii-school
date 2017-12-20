<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2016
 * @package   yii2-tree-manager
 * @version   1.0.6
 */

namespace getpu\tree\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use getpu\tree\TreeView;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * Trait that must be used by the Tree model
 */
trait TreeTrait
{
    /**
     * @var array the list of boolean value attributes
     */
    public static $boolAttribs = [
        'active',
        'selected',
        'disabled',
        'readonly',
        'visible',
        'collapsed',
        'movable_u',
        'movable_d',
        'movable_r',
        'movable_l',
        'removable',
        'removable_all'
    ];

    /**
     * @var array the default list of boolean attributes with initial value = `false`
     */
    public static $falseAttribs = [
        'selected',
        'disabled',
        'readonly',
        'collapsed',
        'removable_all'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return ''; // ensure you return a valid table name in your extended class
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $treeQuery = isset(self::$treeQueryClass) ? self::$treeQueryClass : TreeQuery::classname();
        return new $treeQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function createQuery()
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $treeQuery = isset(self::$treeQueryClass) ? self::$treeQueryClass : TreeQuery::classname();
        return new $treeQuery(['modelClass' => get_called_class()]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $module = TreeView::module();
        $settings = ['class' => NestedSetsBehavior::className()] + $module->treeStructure;
        return empty($module->treeBehaviorName) ? [$settings] : [$module->treeBehaviorName => $settings];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        /** @noinspection PhpUndefinedClassConstantInspection */
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /**
         * @var Tree $this
         */
        $module = TreeView::module();
        $nameAttribute = $urlAttribute = $iconAttribute = $iconTypeAttribute = null;
        extract($module->dataStructure);
        $attribs = array_merge([$nameAttribute, $urlAttribute, $iconAttribute, $iconTypeAttribute], static::$boolAttribs);
        $rules = [
            [[$nameAttribute], 'required'],
            [$attribs, 'safe']
        ];
        if ($this->encodeNodeNames) {
            $rules[] = [
                $nameAttribute,
                'filter',
                'filter' => function ($value) {
                    return Html::encode($value);
                }
            ];
        }
        if ($this->purifyNodeIcons) {
            $rules[] = [
                $iconAttribute,
                'filter',
                'filter' => function ($value) {
                    return HtmlPurifier::process($value);
                }
            ];
        }
        return $rules;
    }

    /**
     * Initialize default values
     */
    public function initDefaults()
    {
        /**
         * @var Tree $this
         */
        $module = TreeView::module();
        $iconTypeAttribute = null;
        extract($module->dataStructure);
        $this->setDefault($iconTypeAttribute, TreeView::ICON_CSS);
        foreach (static::$boolAttribs as $attr) {
            $val = in_array($attr, static::$falseAttribs) ? false : true;
            $this->setDefault($attr, $val);
        }
    }

    /**
     * Sets default value of a model attribute
     *
     * @param string $attr the attribute name
     * @param mixed  $val the default value
     */
    protected function setDefault($attr, $val)
    {
        if (empty($this->$attr)) {
            $this->$attr = $val;
        }
    }

    /**
     * Parses an attribute value if set - else returns the default
     *
     * @param string $attr the attribute name
     * @param mixed  $default the attribute default value
     *
     * @return mixed
     */
    protected function parse($attr, $default = true)
    {
        return isset($this->$attr) ? $this->$attr : $default;
    }

    /**
     * Validate if the node is active
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->parse('active');
    }

    /**
     * Validate if the node is selected
     *
     * @return bool
     */
    public function isSelected()
    {
        return $this->parse('selected', false);
    }

    /**
     * Validate if the node is visible
     *
     * @return bool
     */
    public function isVisible()
    {
        return $this->parse('visible');
    }

    /**
     * Validate if the node is readonly
     *
     * @return bool
     */
    public function isReadonly()
    {
        return $this->parse('readonly');
    }

    /**
     * Validate if the node is disabled
     *
     * @return bool
     */
    public function isDisabled()
    {
        return $this->parse('disabled');
    }

    /**
     * Validate if the node is collapsed
     *
     * @return bool
     */
    public function isCollapsed()
    {
        return $this->parse('collapsed');
    }

    /**
     * Validate if the node is movable
     *
     * @param string $dir the direction, one of 'u', 'd', 'l', or 'r'
     *
     * @return bool
     */
    public function isMovable($dir)
    {
        $attr = "movable_{$dir}";
        return $this->parse($attr);
    }

    /**
     * Validate if the node is removable
     *
     * @return bool
     */
    public function isRemovable()
    {
        return $this->parse('removable');
    }

    /**
     * Validate if the node is removable with descendants
     *
     * @return bool
     */
    public function isRemovableAll()
    {
        return $this->parse('removable_all');
    }

    /**
     * Activates a node (for undoing a soft deletion scenario)
     *
     * @param bool $currNode whether to update the current node value also
     *
     * @return bool status of activation
     */
    public function activateNode($currNode = true)
    {
        /**
         * @var Tree $this
         */
        $this->nodeActivationErrors = [];
        $module = TreeView::module();
        extract($module->treeStructure);
        if ($this->isRemovableAll()) {
            $children = $this->children()->all();
            foreach ($children as $child) {
                /**
                 * @var Tree $child
                 */
                $child->active = true;
                if (!$child->save()) {
                    /** @noinspection PhpUndefinedFieldInspection */
                    /** @noinspection PhpUndefinedVariableInspection */
                    $this->nodeActivationErrors[] = [
                        'id' => $child->$idAttribute,
                        'name' => $child->$nameAttribute,
                        'error' => $child->getFirstErrors()
                    ];
                }
            }
        }
        if ($currNode) {
            $this->active = true;
            if (!$this->save()) {
                /** @noinspection PhpUndefinedFieldInspection */
                /** @noinspection PhpUndefinedVariableInspection */
                $this->nodeActivationErrors[] = [
                    'id' => $this->$idAttribute,
                    'name' => $this->$nameAttribute,
                    'error' => $this->getFirstErrors()
                ];
                return false;
            }
        }
        return true;
    }

    /**
     * Removes a node
     *
     * @param bool $softDelete whether to soft delete or hard delete
     * @param bool $currNode whether to update the current node value also
     *
     * @return bool status of activation/inactivation
     */
    public function removeNode($softDelete = true, $currNode = true)
    {
        /**
         * @var Tree $this
         * @var Tree $child
         */
        if ($softDelete == true) {
            $this->nodeRemovalErrors = [];
            $module = TreeView::module();
            extract($module->treeStructure);
            if ($this->isRemovableAll()) {
                $children = $this->children()->all();
                foreach ($children as $child) {
                    $child->active = false;
                    if (!$child->save()) {
                        /** @noinspection PhpUndefinedFieldInspection */
                        /** @noinspection PhpUndefinedVariableInspection */
                        $this->nodeRemovalErrors[] = [
                            'id' => $child->$idAttribute,
                            'name' => $child->$nameAttribute,
                            'error' => $child->getFirstErrors()
                        ];
                    }
                }
            }
            if ($currNode) {
                $this->active = false;
                if (!$this->save()) {
                    /** @noinspection PhpUndefinedFieldInspection */
                    /** @noinspection PhpUndefinedVariableInspection */
                    $this->nodeRemovalErrors[] = [
                        'id' => $this->$idAttribute,
                        'name' => $this->$nameAttribute,
                        'error' => $this->getFirstErrors()
                    ];
                    return false;
                }
            }
            return true;
        } else {
            return $this->removable_all || $this->isRoot() && $this->children()->count() == 0 ?
                $this->deleteWithChildren() : $this->delete();
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $module = TreeView::module();
        $keyAttribute = $nameAttribute = $leftAttribute = $rightAttribute = $depthAttribute = null;
        $treeAttribute = $urlAttribute = $iconAttribute = $iconTypeAttribute = null;
        extract($module->treeStructure + $module->dataStructure);
        $labels = [
            $keyAttribute => Yii::t('tree', 'ID'),
            $nameAttribute => Yii::t('tree', 'Name'),
            $urlAttribute  => Yii::t('tree', 'Url'),
            $leftAttribute => Yii::t('tree', 'Left'),
            $rightAttribute => Yii::t('tree', 'Right'),
            $depthAttribute => Yii::t('tree', 'Depth'),
            $iconAttribute => Yii::t('tree', 'Icon'),
            $iconTypeAttribute => Yii::t('tree', 'Icon Type'),
            'active' => Yii::t('tree', 'Active'),
            'selected' => Yii::t('tree', 'Selected'),
            'disabled' => Yii::t('tree', 'Disabled'),
            'readonly' => Yii::t('tree', 'Read Only'),
            'visible' => Yii::t('tree', 'Visible'),
            'collapsed' => Yii::t('tree', 'Collapsed'),
            'movable_u' => Yii::t('tree', 'Movable Up'),
            'movable_d' => Yii::t('tree', 'Movable Down'),
            'movable_l' => Yii::t('tree', 'Movable Left'),
            'movable_r' => Yii::t('tree', 'Movable Right'),
            'removable' => Yii::t('tree', 'Removable'),
            'removable_all' => Yii::t('tree', 'Removable (with children)')
        ];
        if (!$treeAttribute) {
            $labels[$treeAttribute] = Yii::t('tree', 'Root');
        }
        return $labels;
    }

    /**
     * Generate and return the breadcrumbs for the node
     *
     * @param int $depth the breadcrumbs parent depth
     * @param string $glue the pattern to separate the breadcrumbs
     * @param string $currNodeCss the CSS class to be set for current node
     * @param string $untitled the name to be displayed for a new node
     *
     * @return string the parsed breadcrumbs
     */
    public function getBreadcrumbs(
        $depth = 1,
        $glue = ' &raquo; ',
        $currNodeCss = 'kv-crumb-active',
        $untitled = 'Untitled'
    ) {
        /**
         * @var Tree $this
         */
        if ($this->isNewRecord || empty($this)) {
            return $currNodeCss ? Html::tag('span', $untitled, ['class' => $currNodeCss]) : $untitled;
        }
        $depth = empty($depth) ? null : intval($depth);
        $module = TreeView::module();
        $nameAttribute = ArrayHelper::getValue($module->dataStructure, 'nameAttribute', 'name');
        $crumbNodes = $depth === null ? $this->parents()->all() : $this->parents($depth - 1)->all();
        $crumbNodes[] = $this;
        $i = 1;
        $len = count($crumbNodes);
        $crumbs = [];
        foreach ($crumbNodes as $node) {
            $name = $node->$nameAttribute;
            if ($i === $len && $currNodeCss) {
                $name = Html::tag('span', $name, ['class' => $currNodeCss]);
            }
            $crumbs[] = $name;
            $i++;
        }
        return implode($glue, $crumbs);
    }
}

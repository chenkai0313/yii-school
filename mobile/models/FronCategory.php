<?php

namespace mobile\models;

use Yii;

/**
 * This is the model class for table "{{%fron_category}}".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 */
class FronCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fron_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['root', 'lft', 'rgt', 'lvl', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all'], 'integer'],
            [['lft', 'rgt', 'lvl', 'name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['url'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Unique tree node identifier',
            'root' => 'Tree root identifier',
            'lft' => 'Nested set left property',
            'rgt' => 'Nested set right property',
            'lvl' => 'Nested set level / depth',
            'name' => 'The tree node name / label',
            'url' => 'url',
            'icon' => 'The icon to use for the node',
            'icon_type' => 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
            'active' => 'Whether the node is active (will be set to false on deletion)',
            'selected' => 'Whether the node is selected/checked by default',
            'disabled' => 'Whether the node is enabled',
            'readonly' => 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
            'visible' => 'Whether the node is visible',
            'collapsed' => 'Whether the node is collapsed by default',
            'movable_u' => 'Whether the node is movable one position up',
            'movable_d' => 'Whether the node is movable one position down',
            'movable_l' => 'Whether the node is movable to the left (from sibling to parent)',
            'movable_r' => 'Whether the node is movable to the right (from sibling to child)',
            'removable' => 'Whether the node is removable (any children below will be moved as siblings before deletion)',
            'removable_all' => 'Whether the node is removable along with descendants',
        ];
    }
}

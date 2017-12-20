<?php

namespace backend\modules\videos\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "fron_comment".
 *
 * @property integer $id
 * @property integer $cid
 * @property string $content
 * @property string $review
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronComment extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'content'], 'required'],
            [['cid','review'], 'integer'],
          //  [['created_at'],'date','timestampAttribute' => 'created_at','format' => 'yyyy-M-d H:m:s'],
            [['content'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cid' => Yii::t('app', 'Video Cid'),
            'content' => Yii::t('app', 'Content'),
            'review'  => Yii::t('app', 'Review'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}

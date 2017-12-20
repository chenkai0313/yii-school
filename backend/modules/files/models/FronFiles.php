<?php

namespace backend\modules\files\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use backend\modules\files\behaviors\FileUploadBehavior;

/**
 * This is the model class for table "fron_files".
 *
 * @property integer $id
 * @property integer $tid
 * @property string $host
 * @property string $name
 * @property string $extension
 * @property integer $size
 * @property integer $created_at
 * @property integer $updated_at
 */
class FronFiles extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'Timestamp' => [
                'class' => TimestampBehavior::className(),
            ],

            'Uploaded' => [
                'class' => FileUploadBehavior::className(),
                'allowFiles' => [
                    FileUploadBehavior::IMAGES => [
                        'extension' => ['jpg','jpeg','gif','png'],
                    ],
                    FileUploadBehavior::VIDEOS => [
                        'extension' => ['flv','mp4','rmvb','avi'],
                    ],
                    FileUploadBehavior::PDFS   => [
                        'extension' => ['pdf'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fron_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid', 'name', 'extension', 'size'], 'required'],
            [['id', 'tid', 'size', 'created_at', 'updated_at'], 'integer'],
            [['host'], 'string', 'max' => 512],
            [['name'], 'string', 'max' => 36],
            [['extension'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tid' => 'Tid',
            'host' => 'Host',
            'name' => 'Name',
            'extension' => 'Extension',
            'size' => 'Size',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

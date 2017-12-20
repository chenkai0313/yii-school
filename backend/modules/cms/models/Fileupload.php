<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fileupload".
 *
 * @property integer $id
 * @property string $filename
 * @property integer $filepath
 * @property integer $filecreate_at
 * @property integer $create_at
 * @property string $pid
 * @property string $content
 */
class Fileupload extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'fileupload';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['filename', 'filepath', 'filecreate_at', 'create_at', 'pid', 'content'], 'required'],
            [['filepath', 'filecreate_at', 'create_at'], 'integer'],
            [['filename'], 'string', 'max' => 50],
            [['pid'], 'string', 'max' => 20],
            [['content'], 'string', 'max' => 4946],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'filename' => '文件名称',
            'filepath' => 'Filepath',
            'filecreate_at' => 'Filecreate At',
            'create_at' => 'Create At',
            'pid' => 'Pid',
            'content' => 'Content',
        ];
    }

}

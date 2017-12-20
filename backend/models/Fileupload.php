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
            [['filename', 'filepath', 'filecreate_at', 'create_at', 'pid',], 'required'],
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
            'filepath' => '文件路径',
            'filecreate_at' => '文件上传时间',
            'create_at' => '发布时间',
            'pid' => '所属',
            'content' => '内容',
        ];
    }

}

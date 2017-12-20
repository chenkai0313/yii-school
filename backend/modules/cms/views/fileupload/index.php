<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FileuploadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '相关文件';
?>
<div class="fileupload-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('创建相关文件', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'filename',
            'filepath',
            'filecreate_at',
            'create_at',
            'pid',
            // 'content',
            ['class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update}  {delete}',
                'buttons' => [
                    'add' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-plus></span>', $url, ['title' => '添加']);
                    },
                ],
                'headerOptions' => ['width' => '80']
            ],
        ],
    ]);
    ?>
</div>
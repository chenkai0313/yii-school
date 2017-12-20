<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Fileupload */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fileuploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fileupload-view">



    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除吗?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'filename',
            'filepath',
            'filecreate_at',
            'create_at',
            'pid',
        ],
    ])
    ?>

</div>
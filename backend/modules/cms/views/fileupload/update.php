<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Fileupload */

$this->title = '修改名称为: ' . $model->filename;
$this->params['breadcrumbs'][] = ['label' => 'Fileuploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fileupload-update">



    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
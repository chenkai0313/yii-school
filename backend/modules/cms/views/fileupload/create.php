<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Fileupload */

$this->title = '发布相关文件';
$this->params['breadcrumbs'][] = ['label' => 'Fileuploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fileupload-create">



    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>


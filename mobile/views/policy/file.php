<?php

use yii\widgets\LinkPager;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <link href="<?= APP_WEB; ?>css/style.css" rel="stylesheet" />
        <script src="<?= APP_WEB; ?>js/jquery-1.9.1.min.js"></script>
        <script src="<?= APP_WEB; ?>js/index.js"></script>
        <script src="<?= APP_WEB; ?>js/jqPaginator.js"></script>
        <title>浙江大学创新创业学院-政策公告</title>
    </head>

    <body>
        <?php echo $this->render('//public/header'); ?>
        <!--==================导航==================-->
        <div class="policy-notice">
            <div style="margin-left: 10px;">
                <h3>相关文件</h3>
            </div>


            <div>
                <div class="policy-info">
                    <ul class="p-1">
                        <?php foreach ($model as $value) { ?>

                            <li class="policy-items">
                                <ul>
                                    <a href="<?= $value['filepath'] ?> " download="<?= $value['filepath'] ?>">
                                        <li>
                                            <h3 class="time"><?= $value['create_at'] ?></h3></li>
                                        <li><?= $value['filename'] ?></li>
                                    </a>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                    <?php echo LinkPager::widget(['pagination' => $pagination]) ?>
                    <div class="back" style="text-align:right;">
                        <a href="<?php echo \yii\helpers\Url::toRoute(['policy/notice']); ?>" style="display:inline-block;float:right;margin:0 5px 10px 0; width:100px;height:25px;font-size:14px;line-height:25px;text-align:center;border:1px solid #004ea2;display:none; color:#004ea2;">返回</a></div>
                </div>
            </div>
        </div>
        <!--底部开始-->
        <?php echo $this->render('//public/footer'); ?>


    </body>
</html>
<script type="text/javascript">
    $(function () {
        $('.begin').bind('click', function () {
            $('.policy-notice .back a').css("display", "block");
            $('.pagination').css('display', "none")
        })
        $('.policy-notice .back a').bind('click', function () {
            $(this).css("display", "none")
            $('.pagination').css("display", "block")
        })
    })
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <title>浙江大学创新创业学院-创业空间</title>
</head>

<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="space">
    <div class="center">
        <div class="banner">
            <img src="images/space.png">
        </div>
        <div class="news-list clearfix">
            <ul class="news-bar clearfix">
                <li><a class="active">基本介绍</a></li>
                <!--                     <li><a>最新公告</a></li>
                                    <li><a>文件下载</a></li> -->
                <li><a href="#">团队风采</a></li>
            </ul>
            <div>
                <div class="news-menu">
                    <div class="basic-intro">
                        <h3><?=$model['title'];?></h3>
                        <?=$model['content'];?>
                    </div>
                </div>
                <div class="news-menu d-n">
                    <?php
                        if(!empty($modelImg)){
                    ?>
                    <div class="wrap">


                        <?php foreach($notice as $item){?>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['space_info','id'=>$item["id"],]);?>">
                            <div class="imgs">

                                   <img style="height:120px" src="<?= $item->files->host . DIRECTORY_SEPARATOR. $item->files->name ?>" />
                            </div>
                        </a>
                        <?php }?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->render('//public/footer');?>
<script src="<?=APP_WEB;?>js/index.js"></script>
</body>
</html>
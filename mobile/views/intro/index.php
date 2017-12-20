<?php

use yii\helpers\Html;

$cache = Yii::$app->cache;
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
        <title>学院介绍</title>
    </head>

    <body>
        <?php echo $this->render('//public/header'); ?>
        <!--==================导航==================-->
        <div class="news-detail_1">
            <div class="center">
               <div class="banner">
                   <img src="<?=APP_WEB;?>images/newbg.png" alt="">
                   <div class="banner-back">
                        <div class="text">
                            <span ><?=date("Y-m-d H:i:s", time());?></span>
                            <p>机构设置</p>
                        </div>
                    </div>
              </div>
                <div class="article" style="margin-top: 50px;">
                    <?php
                    $result = Yii::$app->db->createCommand('SELECT * FROM fron_config where name="web_institution" ')
                            ->queryAll();
                    echo $result[0]['value'];
                    ?>


                </div>



                <div class="clearfix"></div>
                <div class="advise-read ">
                    <h3 class="title">推荐阅读</h3>
                    <ul>
                        <?php
                        foreach ($recommend as $value) {
                            ?>
                            <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/detail', 'id' => $value["id"],]); ?>"><?= $value["title"]; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>

            </div>

            <?php echo $this->render('//public/footer'); ?>

    </body>

</html>
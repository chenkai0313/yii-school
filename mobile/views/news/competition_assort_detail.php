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
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-创业大赛详情</title>
</head>

<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="news-detail_12">
    <div class="center">
        <div class="banner">
            <img src="<?=APP_WEB;?>images/newbg.png" alt="">
            <div class="banner-back">
                <div class="text">
                    <span class="time fr"><?=date("Y-m-d H:i:s", $model['created_at']);?></span><span class="scan-record"><?=$model['clicked'];?></span>
                    <p><?=$model['title'];?></p>
                </div>
            </div>
        </div>

        <div class="content">
            <?=$model['content'];?>
            <?php
                if(!empty($modelTitel)){
            ?>
            <div class="year">
                <p class="year_title">浙江大学历年成绩</p>
                <div class="con">
                    <ul class="first">
                        <?php
                            foreach($modelTitel as $value){
                        ?>
                        <li>
                            <p class="year_list"><?=$value['tag'];?></p>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                    <ul class="second">
                        <?php
                        foreach($modelTitel as $value){
                        ?>
                        <li>
                            <?php
                            foreach($value['fronCompetitionAssortResults'] as $values){
                            ?>
                            <p class="get_detail"><?=$values['title'];?></p>
                            <?php
                            }
                            ?>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
                }
            ?>
        </div>


        <div class="clearfix"></div>
        <div class="advise-read ">
            <h3 class="title">推荐阅读</h3>
            <ul>
                <?php
                foreach ($recommend as $value) {
                ?>
                <li><a href="<?php echo \yii\helpers\Url::toRoute(['news/detail','id'=>$value["id"],]);?>"><?=$value["title"];?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php echo $this->render('//public/footer');?>

</body>

</html>
<script>
    $(function(){
        var $parent = $('.first li');
        $parent.click(function(){
            $(this).css({"background-color":"#004ea2",
                "color":"#fff",
            }).siblings().css({"background-color":"#fff",
                "color":"#004ea2",
            });
            var index = $parent.index(this);
            $('.second li').eq(index).show().siblings().hide();
        })
    })
</script>

<script type="text/javascript">
    $(function(){
        $('.second li').eq(0).show().siblings().hide();
        $('.first li').eq(0).css({"background-color":"#004ea2",
            "color":"#fff",
        })
    })
</script>
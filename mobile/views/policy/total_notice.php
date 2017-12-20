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
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <title>浙江大学创新创业学院-元空间</title>
</head>

<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="space">
    <div class="center">
        <div class="total_notice ">
            <ul class="news-bar ">
                <li><a>全部公告</a></li>
            </ul>
            <div class="wrap" id="container">
                <ul>
                    <?php
                    foreach ($model as $value) {
                    ?>
                    <a href="<?php echo \yii\helpers\Url::toRoute(['policy/detail','id'=>$value["id"],]);?>">
                        <li>
                            <div class="detail">
                                <span><?=date('Y/m/d',$value['created_at']);?></span>
                                <p><?=$value['title'];?></p>
                            </div>
                        </li>
                    </a>
                    <?php
                    }
                    ?>
                </ul>
               
            </div>
             <?= LinkPager::widget(['pagination' => $pages]); ?>
        </div>
    </div>
</div>
<?php echo $this->render('//public/footer');?>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        var index = 1;
        $(".nav-icon").click(function(){
        $(".nav-icon").animate({top:"-=1px"},30).animate({top:"+=1px"},30);
            index++;
            console.log(index);
        });
        $(".nav-icon").click(function(){
        if(index%2 == 0){
            $(".nav").fadeIn(500);
        }
        if(index%2 != 0){
            $(".nav").fadeOut(500);
        }
        });
})
</script>
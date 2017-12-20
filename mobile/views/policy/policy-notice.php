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
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <script src="<?=APP_WEB;?>js/jqPaginator.js"></script>
    <title>浙江大学创新创业学院-政策公告</title>
</head>

<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="policy-notice">
    <div class="srh-wrapper">
        <div class="local-search">站内搜索</div>
    </div>
    <div>
        <div class="policy-info">
            <ul class="p-1">
                <?php
                foreach ($notice as $value) {
                ?>
                <li class="policy-items">
                    <ul>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['policy/detail','id'=>$value["id"],]);?>">
                            <li>
                                <h3 class="time"><?=date('Y/m/d',$value['created_at']);?></h3></li>
                            <li><?=$value['title'];?></li>
                        </a>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
            <?= LinkPager::widget(['pagination' => $pages]); ?>
            <div class="back" style="text-align:right;">
            <a href="<?php echo \yii\helpers\Url::toRoute(['policy/notice']);?>" style="display:inline-block;float:right;margin:0 5px 10px 0; width:100px;height:25px;font-size:14px;line-height:25px;text-align:center;border:1px solid #004ea2;display:none; color:#004ea2;">返回</a></div>
        </div>
    </div>
</div>
<!--底部开始-->
<?php echo $this->render('//public/footer');?>

<!--pop-search-->
<div class="pop-search">
    <div class="layer"></div>
    <div class="content">
        <div class="search">
            <div class="title">站内搜索</div>
            <div class="srchbody">
                    <div class="ipt"  style="display:none">
                        <label for="">搜索方式：</label>
                        <select name="cars">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="fiat">Fiat</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                    <div class="ipt">
                        <label for="">关键内容：</label>
                        <input type="text" class="srhtext">
<!--                        <input type="submit" value="" class="srhsbt">-->
                    </div>
                    <input class="begin" type="submit" value="开始搜索">
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        $(".begin").click(function(){
            var text = $('.srhtext').val();
            if(text!=''){
                $.ajax({
                    url: '?r=policy/notice_select',
                    dataType:'json',
                    type: 'get',
                    data: {
                        text:text
                    },
                    success: function (data) {
                        $(".p-1").html('');
                        for(i in data){
                        var date = new Date(data[i]["created_at"]*1000);
                        var date2 = date.toISOString().slice(0,10);
                        var date3 = date2.replace(/-/g,"/");
                        console.log(date2)
                            var result = '';
                            result += '  <li class="policy-items"> ';
                            result += '  <ul>';
                            result += '  <a href="?r=policy/detail&id='+data[i]["id"]+'">';
                            result += '  <li>';
                            result += '  <h3 class="time">'+date3+'</h3>';
                            result += '  </li>';
                            result += '  <li>'+data[i]["title"]+'</li>';
                            result += '  </a>';
                            result += '  </ul>';
                            result += '  </li>';
                            $(".p-1").append(result);
                        }
                    }
                });
            }
        });
    });
    //弹出搜索
    $(function() {
        $(".local-search").on("click", function() {
            $(".pop-search").fadeIn("600");
        });
        $(".pop-search .layer").on("click", function() {
            $(".pop-search").fadeOut("600");
        });
        $(".begin").on("click", function() {
            $('.pop-search').hide();
        });
    });
</script>
</body>
</html>
<script type="text/javascript">
    $(function(){
        $('.begin').bind('click',function(){
            $('.policy-notice .back a').css("display","block");
            $('.pagination').css('display',"none")
        })
        $('.policy-notice .back a').bind('click',function(){
            $(this).css("display","none")
            $('.pagination').css("display","block")
        })
    })
</script>
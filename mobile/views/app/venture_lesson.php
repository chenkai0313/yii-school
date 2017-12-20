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
    <link href="<?=APP_WEB;?>css/jquery.bxslider.css" rel="stylesheet" />
    <link href="<?=APP_WEB;?>css/style.css" rel="stylesheet" />
    <link href="<?=APP_WEB;?>css/font-awesome.min.css" rel="stylesheet">
    <script src="<?=APP_WEB;?>js/jquery-1.9.1.min.js"></script>
    <script src="<?=APP_WEB;?>js/jquery.bxslider.js"></script>
    <script src="<?=APP_WEB;?>js/jqPaginator.js"></script>
    <script src="<?=APP_WEB;?>js/index.js"></script>
    <title>浙江大学创新创业学院-创业课程</title>
</head>

<body>
<?php echo $this->render('//public/header');?>
<!--==================导航==================-->
<div class="venture-lesson">
    <div class="center">

        <div class="banner">
            <ul class="bxslider" id="banner">
                <?php
                foreach ($modelBanner as $value) {
                ?>
                <li>
                    <a href="<?php echo \yii\helpers\Url::toRoute(['app/lesson_detail','id'=>$value["id"],]);?>">
                        <img src="<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>" />
                    </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="new-lesson">
            <div class="search">
                <input class="srh jq_val" type="text" />
                <input class="sub jq_submit" type="submit" value="" style="cursor:pointer;">
            </div>

            <div class="lesson-title">
                最新课程
            </div>
            <div class="lesson-list p-2">
                <?php
                foreach ($model as $value) {
                ?>
                <div class="course fl">
                    <a href="<?php echo \yii\helpers\Url::toRoute(['app/lesson_detail','id'=>$value["id"],]);?>">
                        <div class="class_pic" style="background:url(<?php echo $value['fronFiles']['host'].'/'.$value['fronFiles']['name'];?>) no-repeat center center;background-size:cover;"></div>
                        <p><?=$value['title'];?></p>
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
            <ul class="pagination jq_page" id="pages">
                <li class="prev"><a href="javascript:void(0)" data-page="1">&laquo;</a></li>
                <li style="font-size: 12px;">当前第1页</li>
                <li class="next"><a href="javascript:void(0)" data-page="2">&raquo;</a></li>
            </ul>
        </div>
        <div class="new-lesson lesson2">
            <div class="lesson-title">
                最多观看
            </div>
            <div class="lesson-list p-1">
                <?php
                foreach ($modelNew as $value) {
                ?>
                <div class="course fl">
                    <a href="<?php echo \yii\helpers\Url::toRoute(['app/lesson_detail','id'=>$value["id"],]);?>">
                        <div class="class_pic" style="background:url(<?php echo $value['fronFiles']['host']."/".$value['fronFiles']['name'];?>) no-repeat center center;background-size:cover;"></div>
                        <p><?=$value['title'];?></p>
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
            <ul class="pagination jq_pages" id="page">
                <li class="prev"><a href="javascript:void(0)" data-page="1">&laquo;</a></li>
                <li style="font-size: 12px;">当前第1页</li>
                <li class="next"><a href="javascript:void(0)" data-page="2">&raquo;</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


<?php echo $this->render('//public/footer');?>

</body>
<script>
    $(document).ready(function(){
        var width = screen.width;
        var page_cur = 1; //当前页
        var total_num, page_size, page_total_num;//总记录数,每页条数,总页数
        function getData(page) { //获取当前页数据
            $.ajax({
                type: 'GET',
                url: '?r=app/lesson_next',
                data: {'pages': page},
                dataType: 'json',
                success: function(json) {
                    console.log(json);
                    $(".p-1").html('');
                    total_num = json.other.count;//总记录数
                    page_size = json.other.size;//每页数量
                    page_cur = page;//当前页
                    page_total_num = json.other.pageNum;//总页数
                    var list = json['data'];
                    if(page_cur <= 1){
                        $.each(list, function(index, array) { //遍历返回json
                            var result = '';
                            result += '  <div class="course fl"> ';
                            result += '  <a href="?r=app/lesson_detail&id='+array["id"]+'">';
                            result += '  <div class="class_pic" style="background:url('+array['fronFiles']['host']+'/'+array["fronFiles"]["name"]+')'+'no-repeat center center;background-size:cover;'+'height:'+width*0.2956+'px !important;"></div>';
                            result += '  <p>'+array["title"]+'</p>';
                            result += '  </a>';
                            result += '  </div>';
                            $(".p-1").append(result);
                        });
                        $(".jq_pages").html('');
                        var pages = '';
                        pages += '<li class="prev"><a href="javascript:void(0)" data-page="'+(parseInt(page))+'">&laquo;</a></li>';
                        pages += '<li style="font-size: 12px;">当前第'+parseInt(page)+'页</li>';
                        pages += '<li class="next"><a href="javascript:void(0)" data-page="'+(parseInt(page)+1)+'">&raquo;</a></li>';
                    }else if(page_cur >= page_total_num){
                        $.each(list, function(index, array) { //遍历返回json
                            var result = '';
                            result += '  <div class="course fl"> ';
                            result += '  <a href="?r=app/lesson_detail&id='+array["id"]+'">';
                            result += '  <div class="class_pic" style="background:url('+array['fronFiles']['host']+'/'+array["fronFiles"]["name"]+')no-repeat center center;background-size:cover;'+'height:'+width*0.2956+'px !important;"></div>';
                            result += '  <p>'+array["title"]+'</p>';
                            result += '  </a>';
                            result += '  </div>';
                            $(".p-1").append(result);
                        });
                        $(".jq_pages").html('');
                        var pages = '';
                        pages += '<li class="prev"><a href="javascript:void(0)" data-page="'+(parseInt(page)-1)+'">&laquo;</a></li>';
                        pages += '<li style="font-size: 12px;">当前第'+parseInt(page)+'页</li>';
                        pages += '<li class="next"><a href="javascript:void(0)" data-page="'+(parseInt(page_total_num)+1)+'">&raquo;</a></li>';
                    }else{
                        $.each(list, function(index, array) { //遍历返回json
                            var result = '';
                            result += '  <div class="course fl"> ';
                            result += '  <a href="?r=app/lesson_detail&id='+array["id"]+'">';
                            result += '  <div class="class_pic" style="background:url('+array['fronFiles']['host']+'/'+array["fronFiles"]["name"]+')no-repeat center center;background-size:cover;'+'height:'+width*0.2956+'px !important;"></div>';
                            result += '  <p>'+array["title"]+'</p>';
                            result += '  </a>';
                            result += '  </div>';
                            $(".p-1").append(result);
                        });
                        $(".jq_pages").html('');
                        var pages = '';
                        pages += '<li class="prev"><a href="javascript:void(0)" data-page="'+(parseInt(page)-1)+'">&laquo;</a></li>';
                        pages += '<li style="font-size: 12px;">当前第'+parseInt(page)+'页</li>';
                        pages += '<li class="next"><a href="javascript:void(0)" data-page="'+(parseInt(page)+1)+'">&raquo;</a></li>';
                    }
                    $(".jq_pages").append(pages);
                },
            });
        }

        $(function() {
            $(document).on("click","#page a",function(){
                var page = $(this).attr("data-page");//获取当前页
                getData(page);
            });
        });








        //下一条
//        $('.jq_next').on("click",function(){
//            var page = $(this).attr('data-page');
//            var one = parseInt('1');
//            var pageJia = parseInt(page)+one;
//            var pageJian = parseInt(page)-one;
//            $.ajax({
//                url: '?r=app/lesson_next',
//                dataType:'json',
//                type: 'get',
//                data: {
//                    data:page
//                },
//                success: function (data) {
//                    $(".p-1").html('');
//                    for(i in data){
//                        var result = '';
//                        result += '  <div class="course fl"> ';
//                        result += '  <a href="'+data[i]["title"]+'">';
//                        result += '  <img src="'+data[i]["fronFiles"]["host"]+'/'+data[i]["fronFiles"]["name"]+'" />';
//                        result += '  <p>'+data[i]["title"]+'</p>';
//                        result += '  </a>';
//                        result += '  </div>';
//                        $(".p-1").append(result);
//                    }
//                    $("#jq_pages").html('');
//                    var pages = '';
//                    pages += '<li class="prev"><a href="javascript:;" class="jq_prevs" data-page="'+pageJian+'">&laquo;</a></li>';
//                    pages += '<li><a href="javascript:;" class="jq_main" data-page="'+pageJian+'">'+page+'</a></li>';
//                    pages += '<li class="active"><a href="javascript:;" class="jq_cent" data-page="'+pageJia+'">'+pageJia+'</a></li>';
//                    pages += '<li class="next"><a href="javascript:;" class="jq_next" data-page="'+pageJia+'">&raquo;</a></li>';
//                    $("#jq_pages").append(pages);
//
//                    //上一条
//                    prev();
//                }
//            });
//        });


    });
</script>
</html>
<script>
    //banner
    $(function() {
        $("#banner").bxSlider({
            auto: false,
            mode: "horizontal",
            pause: 2500,
            speed: 500,
            controls: false,
            autoHover: true,
        });
    });

//    //分页1
//    $.jqPaginator('#pagination1', {
//        totalPages: 100,
//        visiblePages: 4,
//        currentPage: 1,
//        prev: '<li class="prev"><a href="javascript:;">上一页</a></li>',
//        next: '<li class="next"><a href="javascript:;">下一页</a></li>',
//        page: '<li class="page"><a href="javascript:;">{{page}}</a></li>',
//    });
//
//    //分页2
//    $.jqPaginator('#pagination2', {
//        totalPages: 100,
//        visiblePages: 4,
//        currentPage: 1,
//        prev: '<li class="prev"><a href="javascript:;">上一页</a></li>',
//        next: '<li class="next"><a href="javascript:;">下一页</a></li>',
//        page: '<li class="page"><a href="javascript:;">{{page}}</a></li>',
//    });
</script>
<script type="text/javascript">
    var width = screen.width;
    $(function(){
        var $nodes = $('.new-lesson .course .class_pic');
        $nodes.each(function(){
            $(this).css("height",width*0.2956)
        })
    })
</script>

<script>
    $(document).ready(function(){
        var width = screen.width;
        var page_cur = 1; //当前页
        var total_num, page_size, page_total_num;//总记录数,每页条数,总页数
        function getData(page) { //获取当前页数据
            $.ajax({
                type: 'GET',
                url: '?r=app/lesson2_next',
                data: {'pages': page},
                dataType: 'json',
                success: function(json) {
                    console.log(json);
                    $(".p-2").html('');
                    total_num = json.other.count;//总记录数
                    page_size = json.other.size;//每页数量
                    page_cur = page;//当前页
                    page_total_num = json.other.pageNum;//总页数
                    var list = json['data'];
                    if(page_cur <= 1){
                        $.each(list, function(index, array) { //遍历返回json
                            var result = '';
                            result += '  <div class="course fl"> ';
                            result += '  <a href="?r=app/lesson_detail&id='+array["id"]+'">';
                            result += '  <div class="class_pic" style="background:url('+array['fronFiles']['host']+'/'+array["fronFiles"]["name"]+')'+'no-repeat center center;background-size:cover;'+'height:'+width*0.2956+'px !important;"></div>';
                            result += '  <p>'+array["title"]+'</p>';
                            result += '  </a>';
                            result += '  </div>';
                            $(".p-2").append(result);
                        });
                        $(".jq_page").html('');
                        var pages = '';
                        pages += '<li class="prev"><a href="javascript:void(0)" data-page="'+(parseInt(page))+'">&laquo;</a></li>';
                        pages += '<li style="font-size: 12px;">当前第'+parseInt(page)+'页</li>';
                        pages += '<li class="next"><a href="javascript:void(0)" data-page="'+(parseInt(page)+1)+'">&raquo;</a></li>';
                    }else if(page_cur >= page_total_num){
                        $.each(list, function(index, array) { //遍历返回json
                            var result = '';
                            result += '  <div class="course fl"> ';
                            result += '  <a href="?r=app/lesson_detail&id='+array["id"]+'">';
                            result += '  <div class="class_pic" style="background:url('+array['fronFiles']['host']+'/'+array["fronFiles"]["name"]+')no-repeat center center;background-size:cover;'+'height:'+width*0.2956+'px !important;"></div>';
                            result += '  <p>'+array["title"]+'</p>';
                            result += '  </a>';
                            result += '  </div>';
                            $(".p-2").append(result);
                        });
                        $(".jq_page").html('');
                        var pages = '';
                        pages += '<li class="prev"><a href="javascript:void(0)" data-page="'+(parseInt(page)-1)+'">&laquo;</a></li>';
                        pages += '<li style="font-size: 12px;">当前第'+parseInt(page)+'页</li>';
                        pages += '<li class="next"><a href="javascript:void(0)" data-page="'+(parseInt(page_total_num)+1)+'">&raquo;</a></li>';
                    }else{
                        $.each(list, function(index, array) { //遍历返回json
                            var result = '';
                            result += '  <div class="course fl"> ';
                            result += '  <a href="?r=app/lesson_detail&id='+array["id"]+'">';
                            result += '  <div class="class_pic" style="background:url('+array['fronFiles']['host']+'/'+array["fronFiles"]["name"]+')no-repeat center center;background-size:cover;'+'height:'+width*0.2956+'px !important;"></div>';
                            result += '  <p>'+array["title"]+'</p>';
                            result += '  </a>';
                            result += '  </div>';
                            $(".p-2").append(result);
                        });
                        $(".jq_page").html('');
                        var pages = '';
                        pages += '<li class="prev"><a href="javascript:void(0)" data-page="'+(parseInt(page)-1)+'">&laquo;</a></li>';
                        pages += '<li style="font-size: 12px;">当前第'+parseInt(page)+'页</li>';
                        pages += '<li class="next"><a href="javascript:void(0)" data-page="'+(parseInt(page)+1)+'">&raquo;</a></li>';
                    }
                    $(".jq_page").append(pages);
                },
            });
        }

        $(function() {
            $(document).on("click","#pages a",function(){
                var page = $(this).attr("data-page");//获取当前页
                getData(page);
            });
        });








        //下一条
//        $('.jq_next').on("click",function(){
//            var page = $(this).attr('data-page');
//            var one = parseInt('1');
//            var pageJia = parseInt(page)+one;
//            var pageJian = parseInt(page)-one;
//            $.ajax({
//                url: '?r=app/lesson_next',
//                dataType:'json',
//                type: 'get',
//                data: {
//                    data:page
//                },
//                success: function (data) {
//                    $(".p-1").html('');
//                    for(i in data){
//                        var result = '';
//                        result += '  <div class="course fl"> ';
//                        result += '  <a href="'+data[i]["title"]+'">';
//                        result += '  <img src="'+data[i]["fronFiles"]["host"]+'/'+data[i]["fronFiles"]["name"]+'" />';
//                        result += '  <p>'+data[i]["title"]+'</p>';
//                        result += '  </a>';
//                        result += '  </div>';
//                        $(".p-1").append(result);
//                    }
//                    $("#jq_pages").html('');
//                    var pages = '';
//                    pages += '<li class="prev"><a href="javascript:;" class="jq_prevs" data-page="'+pageJian+'">&laquo;</a></li>';
//                    pages += '<li><a href="javascript:;" class="jq_main" data-page="'+pageJian+'">'+page+'</a></li>';
//                    pages += '<li class="active"><a href="javascript:;" class="jq_cent" data-page="'+pageJia+'">'+pageJia+'</a></li>';
//                    pages += '<li class="next"><a href="javascript:;" class="jq_next" data-page="'+pageJia+'">&raquo;</a></li>';
//                    $("#jq_pages").append(pages);
//
//                    //上一条
//                    prev();
//                }
//            });
//        });


    });
</script>

<script type="text/javascript">
            $(function() {
            $(document).on("click",".jq_submit",function(){
                var text = $('.jq_val').val();
                if(text != ''){
                    $.ajax({
                        type: 'GET',
                        url: '?r=app/lesson_select',
                        data: {'text': text},
                        dataType: 'json',
                        success: function(json) {
                            $(".lesson-title").html('');
                            $(".lesson-title").append('搜索课程结果');
                            $(".lesson2").html('');
                            $(".pagination").html('');
                            $(".lesson-list").html('');
                            for(i in json){
                                var result = '';
                                result += '  <div class="course fl">';
                                result += '  <a href="?r=app/lesson_detail&id='+json[i]["id"]+'">';
                                result += '  <img src="'+json[i]["fronFiles"]['host']+'/'+json[i]["fronFiles"]['name']+'">';
                                result += '  <p>'+json[i]["title"]+'</p>';
                                result += '  </a>';
                                result += '  </div>';
                                $(".lesson-list").append(result);
                            }
                            console.log(json);
                        },
                    });
                }else{
                    alert('请输入查询关键词!');
                }
            });
        });
</script>
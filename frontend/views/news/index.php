<?php

/**
 * Created by getpu on 16/9/1.
 */
use frontend\component\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$this->title = '新闻动态';
?>

<div class="notice-trends">
    <div class="left">
        <ul class="pic">
            <li class="pic1" title="<?= Html::encode($top->desc) ?>">
                <a href="<?= Url::to(['news/detail', 'cid' => $top->category->id, 'id' => $top->id]) ?>">
                    <img src="<?= $top->files->host . DIRECTORY_SEPARATOR . $top->files->name ?>" />
                </a>
            </li>
            <?php foreach ($rec as $k => $item) : ?>
                <li class="pic<?= $k + 2 ?>" style="background: url(<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>) no-repeat center center;">
                    <p><a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= StringHelper::truncate($item->desc, 16) ?></a></p>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="cyzx">
            <div class="title">创业资讯</div>
            <?php foreach ($dataProvider->getModels() as $item) : ?>
                <a href="<?= Url::to(['news/detail', 'cid' => $item->cid, 'id' => $item->id]) ?>">
                    <div class="info">
                        <img src="<?= $item->files->host . DIRECTORY_SEPARATOR . $item->files->name ?>" alt="">
                        <p class="bt"><?= Html::encode($item->title) ?><span><?= date('Y-m-d', $item->created_at) ?></span></p>
                        <p class="content"><?= Html::encode($item->desc) ?></p>
                    </div>
                </a>
            <?php endforeach ?>
            <div id="kkpager"></div>
        </div>
    </div>
    <div class="right">
        <div class="title">浙闻速递</div>
        <ul>
            <?php foreach ($reprints as $reprint) : ?>
                <li id="list_demo"><a href="<?= $reprint->url ?>" target="_blank"><?= Html::encode($reprint->title) ?></a><span><?= date('Y-m-d', $reprint->created_at) ?></span></li>
            <?php endforeach; ?>
        </ul>
        <p class="more"><a href="<?= Url::to(['news/list']) ?>">查看所有...</a></p>
    </div>
</div>


<?php
$js = <<<JS
//分页
function getParameter(name) { 
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); 
	var r = window.location.search.substr(1).match(reg); 
	if (r!=null) return unescape(r[2]); return 1;
}

//init
$(function(){
	var totalPage = {$dataProvider->getPagination()->getPageCount()};
	var totalRecords = {$dataProvider->getTotalCount()};
	var pageNo =  getParameter('page');//
	//生成分页
	//有些参数是可选的，比如lang，若不传有默认值

	kkpager.generPageHtml({
		pno : pageNo,
		//总页码
		total : totalPage,
		//总数据条数
		totalRecords : totalRecords,
		//链接前部
		hrefFormer : 'news',
		//链接尾部
		hrefLatter : '.html',
		getLink : function(n){
			return this.hrefFormer + this.hrefLatter + "?page="+n;
		}
		/*
		,lang				: {
			firstPageText			: '首页',
			firstPageTipText		: '首页',
			lastPageText			: '尾页',
			lastPageTipText			: '尾页',
			prePageText				: '上一页',
			prePageTipText			: '上一页',
			nextPageText			: '下一页',
			nextPageTipText			: '下一页',
			totalPageBeforeText		: '共',
			totalPageAfterText		: '页',
			currPageBeforeText		: '当前第',
			currPageAfterText		: '页',
			totalInfoSplitStr		: '/',
			totalRecordsBeforeText	: '共',
			totalRecordsAfterText	: '条数据',
			gopageBeforeText		: '&nbsp;转到',
			gopageButtonOkText		: '确定',
			gopageAfterText			: '页',
			buttonTipBeforeText		: '第',
			buttonTipAfterText		: '页'
		}*/
		
		//,
		//mode : 'click',//默认值是link，可选link或者click
		//click : function(n){
		//	this.selectPage(n);
		//  return false;
		//}
	});
});
JS;
$this->registerCssFile('/assets/css/kkpager_blue.css', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('/assets/js/kkpager.min.js', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJs($js, View::POS_END);
?>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
/**
 * Created by getpu on 16/9/12.
 */

$this->title = '最新文章';
 
?>

<div class="drycargo">
    <div class="dryleft">
        <div class="three">
            <ul>
               <?php foreach($top as $item) : ?>
                <a href="<?= Url::to(['news/detail', 'cid' => $item->cid, 'id' => $item->id])?>">
                    <li><img src="<?=$item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>" alt=""/></li>
                </a>
                <?php endforeach ?>
            </ul>
        </div>

        <div class="dry">
            <div class="title">创业干货</div>
           <?php foreach($dataProvider->getModels() as $item) : ?>
           	<a href="<?= Url::to(['news/detail', 'cid'=> $item->cid ,'id' => $item->id]) ?>">
            <div class="info">
                <img src="<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>" alt="">
                <p class="bt"><?= Html::encode($item->title) ?><span><?= date('Y-m-d', $item->created_at) ?></span></p>
                <p class="content"><?= Html::encode($item->desc) ?></p>
            </div>
            </a>
           <?php endforeach ?>
            <div id="kkpager"></div>
        </div>
    </div>
    <div class="rightimg">
        <ul>
          <?php foreach($rec as $item) : ?>
            <a href="<?= Url::to(['news/detail', 'cid' => $item->cid, 'id' => $item->id]) ?>">
                <li><img src="<?= $item->files->host .DIRECTORY_SEPARATOR. $item->files->name ?>" alt=""></li>
            </a>
          <?php endforeach ?>
        </ul>
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
		hrefFormer : 'latest',
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

$this->registerCssFile('/assets/css/kkpager_blue.css',['depends' => 'frontend\assets\AppAsset']);
$this->registerJsFile('/assets/js/kkpager.min.js', ['depends' => 'frontend\assets\AppAsset']);
$this->registerJs($js);
?>


<?php

/**
 * Created by getpu on 16/9/8.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

?>

<div class="policy">
    <div class="recc">
        <div class="search">
            <div class="title">站内搜索</div>
            <div class="srchbody">
                <form action="">
                    <div class="ipt" style="display:none">
                        <label for="">搜索方式：</label>
                        <select name="Policy[cid]">
                            <option value="">---</option>
                        </select>
                    </div>
                    <div class="ipt">
                        <label for="">关键内容：</label>
                        <input class="srhtext" name="Policy[title]" type="text">
                        <input class="srhsbt" type="submit" value="">
                    </div>
                </form>
            </div>
        </div>
        <div class="list">
            <div class="title">政策汇总</div>
            <div class="listbody">
                <ul>
                    <?php foreach ($dataProvider->getModels() as $item) : ?>
                        <li>
                            <a href="<?= Url::to(['news/detail', 'cid' => $item->category->id, 'id' => $item->id]) ?>"><?= Html::encode($item->title) ?></a><span><?= date('Y-m-d', $item->created_at) ?></span>
                        </li>
                    <?php endforeach ?>
                </ul>
                <div id="kkpager"></div>
            </div>
        </div>
    </div>
</div>


<?php
$js = <<<JS
//分页
function getParameter(name) { 
    if(name === null || name === undefined){
        var reg = new RegExp("(.+)page=[0-9]+|(page=)","i");
        var parameter = window.location.search.substr(1);
        var page = parameter.match(reg);
        if(page !== null && page[2] !== undefined){
              return '?page=';
        }else if(page === null && parameter.length > 1) {
              return '?' +parameter+ '&page=';      
         }else if(page !== null && parameter.length > 1){
              return '?' +page[1] + 'page=';
         }else{
              return '?page='
         }
    }else{
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r!=null) return unescape(r[2]); return 1;
    }
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
		hrefFormer : 'policy.html',
		hrefLatter :  getParameter(),
		
		getLink : function(n) {
			return this.hrefFormer + this.hrefLatter + n;
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

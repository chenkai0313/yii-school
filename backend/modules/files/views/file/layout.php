<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use backend\modules\files\models\FronFiles;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$query = FronFiles::find();

$imagesPage = new Pagination([
    'defaultPageSize' => 18,
    'totalCount' => $query->where(['tid' => 1])->count(),
]);


$images = $query->where(['tid' => 1])
    ->orderBy('id')
    ->offset($imagesPage->offset)
    ->limit($imagesPage->limit)
    ->all();
?>

<div id="file-upload" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index:1200;">
    <div class="modal-dialog" style="width:770px;">
        <div class="modal-content" style="min-height:300px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <ul class="nav nav-pills" role="tablist">
                    <li class="active" role="presentation"><a href="#upload" data-toggle="tab" role="tab" aria-controls="upload">上传文件</a></li>
                    <li class="hide" role="presentation"><a href="#network" data-toggle="tab" role="tab" aria-controls="network">网络文件</a></li>
                    <li role="presentation"><a href="#images" data-toggle="tab" role="tab" aria-controls="images">图片文件</a></li>
                <!--    <li role="presentation"><a href="#videos" data-toggle="tab" role="tab" aria-controls="videos">视频文件</a></li> -->
                </ul>
            </div>
            <div class="modal-body tab-content">
                <div id="upload" class="tab-pane active" role="tabpanel">
                    <form enctype="multipart/form-data">
                        <div class="form-group">
                            <input class="file" type="file" name="file" multiple data-preview-file-type="any" data-upload-url="<?= Url::to(['/files/file/upload']) ?>">
                        </div>
                    </form>
                </div>
                <div id="network" class="tab-pane" role="tabpanel">
                    <form>
                        <input class="form-control" type="text" name="network" placeholder="网络图片地址http://"/>
                        <button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>确定</button>
                    </form>
                </div>

                <div id="images" class="tab-pane" role="tabpanel">
                    <?php Pjax::begin(['id' => 'file-image-list','timeout' => 3600]) ?>
                    <ul class="file-image-items row">
                        <?php foreach ($images as $image) : ?>
                            <li class="col-xs-2 file-image-item" data-id="<?= $image->id ?>" data-url="<?= $image->host.DIRECTORY_SEPARATOR.$image->name ?>">
                                <span class="file-image-scope" style="background-image:url(<?= $image->host.DIRECTORY_SEPARATOR.$image->name ?>)"></span>
                                <span class="file-image-status"></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?= LinkPager::widget(['pagination' => $imagesPage]) ?>
                    <ul class="buttons">
                        <button type="button" class="btn btn-warning">
                            <i class="glyphicon glyphicon-refresh"></i>
                            <span class="hidden-xs">新刷</span>
                        </button>
                        <button class="btn btn-primary">
                            <i class="glyphicon glyphicon-ok"></i>
                            <span class="hidden-xs">确定</span>
                        </button>
                    </ul>
                    <ul class="clearfix"></ul>
                    <?php Pjax::end() ?>
                </div>

            </div>

        </div>
    </div>
</div>

<?php
$js = <<<JS
var opeartion = {}; selectedImageItems = [];
opeartion.image = {
  addItem:function(item){
     if(selectedImageItems.length > 0){
        var exists = false;
        for(var i = 0; i < selectedImageItems.length; i++){
           if(item.id === selectedImageItems[i].id){
               exists = true;
           }
        }
        if(!exists)
         selectedImageItems.push(item);
     }else{
         selectedImageItems.push(item);
     }
  },
  removeItem:function(item){
     if(selectedImageItems.length > 0){
        for(var i = 0; i < selectedImageItems.length; i++){
           if(item.id === selectedImageItems[i].id){
              selectedImageItems.splice(i);
           }
        }
     }
  },
  makeTagli:function(nums,input){
     if(selectedImageItems.length > 0 && nums > 0 ){
        var li = '',ip = '';
       for(var i = 0; i< selectedImageItems.length && i < nums; i++){
          li += '<li class="item item-'+selectedImageItems[i].id+'"><img src="'+selectedImageItems[i].url+'"/><i class="fa fa-times-circle image-close"></i></li>';
          ip += '<input class="item item-'+selectedImageItems[i].id+'" type="hidden" name="'+input+'" value="'+selectedImageItems[i].id+'"/>';
        }
       return {li:li,ip:ip};
     }
     return false;
  },
  makeJson:function(nums){
     if(selectedImageItems.length > 0 && nums > 0){
        var nodes = [];
       for(var i = 0; i< selectedImageItems.length && i < nums; i++){
            var node = {};node.url = selectedImageItems[i].url;
            nodes.push(node);
        }
       return nodes;
     }
     return false;
  },
};

jQuery(document).on("click",".file-image-item",function(event){
  var _this = jQuery(this);
   if(_this.hasClass('file-image-selected')){
     var item = {'id':_this.data('id')};
       opeartion.image.removeItem(item);
       _this.removeClass("file-image-selected");
   }else{
     var item = {'id':_this.data("id"),'url':_this.data("url")};
     opeartion.image.addItem(item);
     _this.addClass("file-image-selected");
   }
});

jQuery(document).on("click",".image-close",function(){
    var _this = jQuery(this), parent = _this.closest(".files-insert"),index =  _this.parent().index();
    parent.find(".input-items input").eq(index).remove();
    parent.find(".image-items li").eq(index).remove();
});

function selectFilesDialog(obj){
   jQuery("#file-upload").modal("show");
   jQuery(document).on("click","#file-image-list .btn-warning",function(){jQuery.pjax.reload({container:"#file-image-list"});selectedImageItems = []});
   jQuery(document).on("click","#file-image-list .btn-primary",function(){jQuery("#file-upload").modal("hide")});
   jQuery(document).one("hide.bs.modal", "#file-upload", function () {
          jQuery(".file-image-item").removeClass("file-image-selected");
           var parent = jQuery(obj.ele).closest(".files-insert");
            if(obj.type === 1 && obj.num === 1){
                var data = opeartion.image.makeTagli(obj.num,obj.name);
                parent.find(".input-items").html(data.ip);
                parent.find(".image-items").html(data.li);
                selectedImageItems = [];
            }
            if(obj.type === 1){
                var input = parent.find(".input-items").children().length;
                if(input < obj.num && input === 0){
                    data = opeartion.image.makeTagli(obj.num,obj.name);
                }else if(input < obj.num && input > 0){
                    data = opeartion.image.makeTagli(obj.num - input,obj.name);
                }else{
                    data = opeartion.image.makeTagli(0);
                }
                 parent.find(".input-items").append(data.ip);
                 parent.find(".image-items").append(data.li);
                 data = [];selectedImageItems = [];
            }
   });
}

UE.registerUI('myinsertimage',function(editor,uiName){
				editor.registerCommand(uiName, {
					execCommand:function(){
					   jQuery("#file-upload").modal("show");
					   jQuery(document).on("click","#file-image-list .btn-warning",function(){jQuery.pjax.reload({container:"#file-image-list"});selectedImageItems = []});
                       jQuery(document).on("click","#file-image-list .btn-primary",function(){jQuery("#file-upload").modal("hide")});
                       jQuery(document).one("hide.bs.modal", "#file-upload", function () {
                       jQuery(".file-image-item").removeClass("file-image-selected");
                             var img = opeartion.image.makeJson(6);
                                if(img.length > 0){
                                     var imglist = [];
									  for (i in img) {
										imglist.push({
											'src' : img[i]['url'],
											'width' : '100%',
									     });
                                      }
                                      editor.execCommand('insertimage', imglist);
                                      img = [];selectedImageItems = [];
                                }
                                return;
                        });
					}
				});
				var btn = new UE.ui.Button({
					name: '插入图片',
					title: '插入图片',
					cssRules :'background-position: -726px -77px',
					onclick:function () {
						editor.execCommand(uiName);
					}
				});
		return btn;
}, 19);
JS;

$this->registerJs(preg_replace("/[\s]+/is"," ",$js), \yii\web\View::POS_END);
?>

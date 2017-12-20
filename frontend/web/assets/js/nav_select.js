function nav_slect(){
    var $oDiv = $("#nav_detail > li");
    $oDiv.find('ul').each(function(){
        if($oDiv.find('ul')){
            $oDiv.find('ul').parent().addClass('bgc')
        }
    })
}
function Clone(){
	    var oDiv = document.getElementById('sec_one'),
        bDiv = document.getElementById('clone_pic');
        bDiv.innerHTML = oDiv.innerHTML;
}
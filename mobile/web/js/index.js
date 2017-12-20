$(function(){
	/*头部js*/
//nav
$(document).ready(function(){
  var index = 1;
  $(".nav-icon").click(function(){
	  $(".nav-icon").animate({top:"-=1px"},30).animate({top:"+=1px"},30);
	  	  index++;
	  	  console.log(index);
  });
  $(".nav-icon").click(function(){
	  if(index%2 == 0){
	  $(".nav").fadeIn(500)
	  }
	  if(index%2 != 0){
	  $(".nav").fadeOut(500);
	  }
  });
});

//nav
 
	 //$(".news .news-bar li").click(function(){
		// $(this).children("a").addClass("active").parent().siblings().children("a").removeClass("active");
		//var num=$(this).index();
		// $($(".news .news-menu")[num]).removeClass("d-n").siblings().addClass("d-n");
     //
	 //});

	$(".competition-notice li").click(function(){
		$(this).children("a").addClass("active").parent().siblings().children("a").removeClass("active");
		var num=$(this).index();
		$($(".competition-menu")[num]).removeClass("d-n").siblings().addClass("d-n");
	});

	
	 $(".article .news-bar li").click(function(){
		 $(this).children("a").addClass("active").parent().siblings().children("a").removeClass("active");
		var num=$(this).index();
		 $($(".article .news-menu")[num]).removeClass("d-n").siblings().addClass("d-n");

	 });

	 $(".space .news-bar li").click(function(){
		 $(this).children("a").addClass("active").parent().siblings().children("a").removeClass("active");
		var num=$(this).index();
		 $($(".space .news-menu")[num]).removeClass("d-n").siblings().addClass("d-n");

	 });
	  $(".teacher .news-bar li").click(function(){
		 $(this).children("a").addClass("active").parent().siblings().children("a").removeClass("active");
		var num=$(this).index();
		 $($(".teacher .news-menu")[num]).removeClass("d-n").siblings().addClass("d-n");

	 });

	})
/*头部js*/
	
  
   
  
   
 
 


	
	
	
	
	 
	 
	 
	
				
	

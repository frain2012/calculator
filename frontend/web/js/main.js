$(function($) {
	$('.nav-sidebar a').click(function(){
		$('.nav-sidebar li.active').removeClass("active");
		$(this).parent('li').addClass('active');
	});
	
	$(".subnav .subnav-title").hover(
	  function () {
		$(this).children('em').addClass("hover");
	  },
	  function () {
		$(this).children('em').removeClass("hover");
	  }
	);
	
	$(".subnav-title .toggle-subnav").click(function(){
		$atr = $(this).parent().siblings('.subnav-menu');
		var tag = $atr.attr('data');
		if(tag == 0){
			$atr.slideDown();
			$atr.attr({'data':1});
		}else{
			$atr.slideUp();
			$atr.attr({'data':0});
		}
	});
	
	$(".subnav-menu a").click(function(){
		$(".subnav-menu a.active").removeClass("active");
		$(this).addClass('active');
	});
	
});

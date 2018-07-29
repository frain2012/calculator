$(document).ready(function(){

	$('[data-toggle="tooltip"]').tooltip();
	
	$('.hdt-sidebar li').click(function(){
		if(!$(this).hasClass('active'))
		{
			$(this).addClass('active').siblings('li.active').removeClass('active');
			if($(this).children('.nav').length)
			{
				$(this).children('.nav').children('li.active').removeClass('active');
				$(this).children('.nav').children('li:first-child').addClass('active');
			}
		}
	});
	
	sidebar_w=$('.col-md-2').width();
        if ($('.hdt-sidebar').length)
    {
	sidebar_t=$('.hdt-sidebar').offset().top;
    }
	window.onscroll=function(){
		if(typeof(sidebar_t)!='undefined') {
			if($(document).scrollTop()>sidebar_t) $('.hdt-sidebar').addClass('hdt-sidebar-fixed').width(sidebar_w);
			else $('.hdt-sidebar').removeClass('hdt-sidebar-fixed');
		}
	};

});
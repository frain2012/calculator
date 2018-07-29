$(document).ready(function(){

    //启用tooltip插件
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    //全局侧边固定菜单内容溢出时启用滚动
    if($(window).width()>640) $('.navbar-fixed-side').niceScroll();//$(".navbar-fir").getNiceScroll().hide()//.resize();
//.niceScroll({cursorcolor: '#fff',railalign: 'right', cursorborder: "none", horizrailenabled: false, zindex: 2001, left: '245px', cursoropacitymax: 0.6, cursorborderradius: "0px", spacebarenabled: false });
    //页面有全局侧边固定二级菜单时主框架侧边偏移增大
    if($('.navbar-sec').length) $('body').addClass('with-navbar-sec');

    /*fixed提示时处理其它fixed元素的位置
     if($('.alert-fixed').length){
     $('body').addClass('with-alert-fixed');
     $('.alert-fixed.alert-dismissable').on('closed.bs.alert',function(){
     $('body').removeClass('with-alert-fixed');
     })
     }
     */

    //页面有表单编辑底部固定菜单时主框架底部偏移增大
    if($('.app-design-action').length&&$(window).width()>640) $('.app-design').css({'padding-bottom':$('.app-design-action').height()+'px'});
    //console.log($('.app-design').offset().left);

    //切换侧栏帮助内容
    if($('.help-wrap').length)
    {

        if($('body').width()>1199) $('body').addClass('with-help')

        $('.help-body').css({'min-height':$('body').height()+20+'px'});

        $('.help-title').click(function()
        {

            $('body').addClass('with-help').find('.help-body').animate({right:'0px',opacity:1},'fast','linear');

        }).find('.icon-close').click(function()
        {


            if($('body').hasClass('with-help')&&$('body').width()<1199)
            {
                $('.help-body').animate({right:'-200px',opacity:0},'slow','linear',function(){$('body').removeClass('with-help')});
            }
            else $('body').addClass('with-help').find('.help-body').animate({right:'0px',opacity:1},'fast','linear',function(){});

            return false;

        });

    }

    //模拟器表单编辑视图控制
    var oldfield=0;
    $('.simulator-field-action').click(function()//toggle view
    {

        var el_parent=$(this).parent('.simulator-field');
        //console.log(el_parent.index())

        //模拟器激活控件切换
        if(el_parent.hasClass('active')) return;
        el_parent.addClass('active').siblings('.simulator-field').removeClass('active');

        //表单激活视图切换
        var el=$('.simulator-field'),
            h=$('.simulator-title').height()+$('.fn-header-static').height();
        for(var i=0;i<el_parent.index();i++)
        {
            h+=$(el[i]).height()+8;
        }

        $('.app-editor-inner').animate({marginTop:h+'px'},'easing-in');
        $('html,body').animate({scrollTop:el_parent.offset().top},'easing-in');
        $($('.app-editor-inner').find('.view')[el_parent.index()]).addClass('active').siblings('.active').removeClass('active');

    }).find('.action-btn.remove').click(function()//delete view
    {

        $(this).parents('.simulator-field').fadeOut(function()
        {

            /*
             oldfield=$(this).index();
             $(this).siblings('.active').removeClass('active');
             $($(this).siblings('.simulator-field')[oldfield]).addClass('active')
             $(this).parents('.app-simulator').siblings('.app-editor').find('.view.active').removeClass('active');
             $($(this).parents('.app-simulator').siblings('.app-editor').find('.view')[$(this).index()]).remove();
             $($(this).parents('.app-simulator').siblings('.app-editor').find('.view')[oldfield]).addClass('active');
             */

            $($(this).parents('.app-simulator').siblings('.app-editor').find('.view')[$(this).index()]).remove();
            $(this).remove();

            $($('.simulator-field')[0]).fadeIn();
            $($('.app-editor').find('.view')[0]).fadeIn();
            $('.app-editor-inner').animate({marginTop:'64px'},'easing-in');
            $('html,body').animate({scrollTop:0},'easing-in');

        });

        return false;

    })

    //delete item
    $('.item-option-delete').click(function()
    {
        $(this).parents('li').remove();
    })

});

//计时器定时用于触发清除toast
var timer;

//清除toast
function hideToast()
{
    if($('.alert-fixed').length) $('.alert-fixed').fadeOut(function(){
        //$('body').removeClass('with-alert-fixed');
        $(this).remove();
    });
    clearTimeout(timer);
}
//触发toast出现
function toggleToast(opt)
{

    //opt.tip String 提示内容
    //opt.role success|danger|default:info 提示类别
    //opt.action true|default:false 显示关闭按钮，role为danger时建议开启
    //opt.delay int|default:3 自动关闭延时（秒）,显示关闭按钮时无效

    hideToast();
    opt.tip=opt.tip||'提示';
    opt.role=opt.role||'info';
    opt.delay=(opt.delay||3)*1000;
    $('body').append('<div class="alert alert-fixed"></div');
    var toast=$('.alert-fixed');
    toast.text(opt.tip).addClass('alert-'+opt.role).fadeIn().click(function(){hideToast()});
    if(opt.action) toast.addClass('alert-dismissable').prepend('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>')
    else timer=setTimeout(hideToast,opt.delay);

}
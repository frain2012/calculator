<?php
use yii\helpers\Html;


$this->title = '登录-商家中心';
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/favicon.ico" rel="favicon">
    <?=Html::cssFile('@web/css/bootstrap.css')?>
    <?=Html::cssFile('@web/css/style.css')?>
    <?=Html::jsFile('@web/js/jquery.2.2.0.min.js')?>
</head>
<body>

<div class="wrap">
    <div class="main-wrap">
        <div class="app app-equal-mainwrap">
            <div class="app-inner">
                <div class="brand-wrap">
                    <h1 class="brand" href="javascript:"><img src="/img/brand.hdt.comb.svg" alt="好店通"/></h1>
                    <p class="brand-title">登录</p>
                    <div class="brand-side">
                        <a href="/site/register">免费注册</a>
                        <small class="text-muted"> - </small>
                        <a href="/site/findpwd">忘记密码</a>
                    </div>
                </div>

                <div class="col-sm-offset-2 col-sm-8 hide" id="error-div">

                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">出错了:</span>
                        <span id="error-msg"></span>
                    </div>

                </div>
                <form class="form-horizontal" onsubmit="return false;">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                <input type="text" class="form-control" name="tel" id="tel" placeholder="请输入登录手机号">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"> </span></span>
                                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="请输入登录密码">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-3">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-text-color"></span></span>
                                <input type="text" class="form-control" name="code" id="code" placeholder="请输入图形验证码" onkeypress="checkLogin(event)">
                            </div>
                        </div>
                        <div class="col-sm-2"><img id='code-img' class="img-rounded" src="/site/captcha" alt="看不清，点击换一张" onclick="refreshCaptcha();" title="看不清，点击换一张"></div>
                    </div>
                    <div class="form-group"><div class="col-sm-6 col-sm-offset-3"><hr></div></div>
                    <div class="form-group">
                        <div class="col-sm-3 col-sm-offset-3">
                            <button class="btn btn-primary btn-lg btn-block" onclick="login();">立即登录</button>
                        </div>
                        <div class="col-sm-3 text-right">
                            <a href="javascript:"  class="btn btn-default btn-lg btn-block" data-toggle="modal" onclick="showMdl();"><small><span class="glyphicon glyphicon-qrcode"></span></small> 微信登录</a>
                        </div>
                    </div>
                </form>


            </div><!--end .app-inner-->
        </div><!--end .app-->
    </div><!--end .main-wrap-->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="wechat">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">微信登录</h4>
            </div>
            <div class="modal-body text-center">

                <h5>打开微信，扫一扫登录</h5>
                <p class="text-muted"></p>
                <p><img id="qrcode_id" alt="刷新重试" style="width:200px;"></p>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    function refreshCaptcha(){
        $.getJSON("/site/captcha?refresh=true",function(res){
            if(res){
                $("#code-img").attr("src",res.url);
            }
        });
    }
    function checkLogin(event)
    {
        if(event.keyCode == 13) {
            login();
        }
    }
    function login()
    {
        var tel = $('#tel').val();
        var pwd = $('#pwd').val();
        var code = $('#code').val();

        if (!tel)
        {
            $('#error-msg').html('请输入手机号');
            $('#error-div').removeClass('hide');
            return;
        }

        if (!pwd)
        {
            $('#error-msg').html('请输入密码');
            $('#error-div').removeClass('hide');
            return;
        }

        if (!code)
        {
            $('#error-msg').html('请输入验证码');
            $('#error-div').removeClass('hide');
            return;
        }

        $.ajax({
            url: '/site/login',
            type: 'post',
            data: {tel:tel,pwd:pwd,code:code},
            dataType: 'json',
            success: function(data) {
                if (data.status == 0)
                {
                    window.location.href = 'http://b.haodian.com/account/switch';
                }
                else if (data.status == 2)
                {
                    $('#error-msg').html(data.msg);
                    $('#error-div').removeClass('hide');
                    refreshCaptcha();
                    $('#code').val('').focus();
                }
                else
                {
                    refreshCaptcha();
                    $('#error-msg').html(data.msg);
                    $('#error-div').removeClass('hide');
                }
            }
        });
    }

    var start_login = false;
    var timer;
    var code_id = '';


    function showMdl() {
        $('#wechat').modal();
        $.ajax({
            url: '?getcode',
            type: 'get',
            dataType: 'json',
            data: {
                c_token:"7e016831-27eb-4971-9d26-603540ba17ce"
            },
            success: function(data) {
                if (data.status)
                {
                    start_login = true;
                    $("#qrcode_id").attr('src',data.qrcode);
                    code_id = data.c_key;

                    return false;
                }else{
                    alert("二维码生成出错了,请关闭弹出框,重试!");
                    return false;
                }

            }
        });
    }

    timer = setInterval('check_bind()',1000);

    function check_bind() {
        if(start_login){
            $.ajax({
                url: '?checkstatus',
                type: 'get',
                dataType: 'json',
                data: {
                    c_key:code_id
                },
                success: function(data) {
                    //alert(msg);
                    if (data.status)
                    {
                        location.reload();
                    }

                }
            });
        }
    }

</script>

<div class="footer" id="footer">
    <p>业务接入详咨QQ:9155091 mobile:18905925655 微信号:imbanping</p>
    <p>© 2018 好店通版权所有 闽ICP备16002731号</p>
</div>
<?=Html::jsFile('@web/js/bootstrap.js')?>
<?=Html::jsFile('@web/js/event.js')?>
</body>
</html>

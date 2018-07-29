<?php
use yii\helpers\Html;


$this->title = '切换-商家中心';
?>
<?=Html::jsFile('@web/js/webuploader.min.js')?>
<?=Html::cssFile('@web/css/webuploader.css')?>
<div class="breadcrumb">
    <a href="/v2">首页</a>
    <span class="text-muted">/</span>
    <a href="/v2/setting">设置</a>
    <span class="text-muted">/</span>
    <span class="text-muted">品牌管理</span>
</div>
<div class="app">
    <div class="app-inner">

        <div class="row">
            <div class="col-sm-offset-2 col-sm-8 hide" id="error-div">

                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">出错了:</span>
                    <span id="error-msg"></span>
                </div>

            </div>


            <form class="form-horizontal hdt-fn-mtm">
                <input type="hidden" name="id" id="id" value="<?=$data->id;?>">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">品牌名</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="name" id="name" value="<?=$data->brand;?>" placeholder="请输入品牌名">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">品牌Logo</label>
                    <div class="col-sm-4" style="display: inline-block;">
                        <div id="uploader-demo">
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                        </div>
                        <span class="label label-warning ">图片宽度100px</span>
                        <div style="margin:5px 0 5px; text-align:left">
                            <input type="hidden" id="brand_logo-0-input" name="brand_logo" value="<?=$data->logo;?>">
                            <img width="100px" id="brand_logo-0-src" src="<?=$data->logo;?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">公司名</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="company_name" id="company_name" value="<?=$data->company;?>" placeholder="请输入公司名">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">服务商代号</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="code" id="code" value="<?=$data->code;?>" placeholder="没有可不填~">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-6">
                        <button type="button" onclick="save();" id="submit-btn" class="btn btn-primary">保存</button>
                    </div>
                </div>

            </form>
            <script>
                jQuery(function() {
                    var uploader = WebUploader.create({
                        auto: true,
                        swf: '/js/Uploader.swf',
                        server: '/site/upload',
                        fileVal:'file',
                        pick: '#filePicker',
                        duplicate: true,
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        }
                    });
                    uploader.on( 'uploadError', function( file ) {
                        alert("上传失败");
                    });
                    uploader.on( 'uploadSuccess', function( file,response) {
                        if(response && response.status==0){
                            $( '#brand_logo-0-input').val(response.url);
                            $( '#brand_logo-0-src').attr({'src':response.url});
                        }
                    });
                });

                function save()
                {
                    var name = $('#name').val();
                    var code = $('#code').val();
                    var id = $('#id').val();
                    var company_name = $('#company_name').val();
                    var wx_qrcode = $("#wx_qrcode-0-input").val();
                    var brand_logo = $("#brand_logo-0-input").val();

                    if (!name)
                    {
                        $('#error-msg').html('请输入品牌名');
                        $('#error-div').removeClass('hide');
                        return;
                    }

                    if(!brand_logo)
                    {
                        $('#error-msg').html('请上品牌Logo');
                        $('#error-div').removeClass('hide');
                        return;
                    }

                    if (!company_name)
                    {
                        $('#error-msg').html('请输入公司名');
                        $('#error-div').removeClass('hide');
                        return;
                    }


                    $('#submit-btn').attr('disabled', true);
                    $.ajax({
                        url: '/setting/biz',
                        type: 'post',
                        data: {brand:name,code:code,id:id,company:company_name,wx_qrcode:wx_qrcode,logo:brand_logo},
                        dataType: 'json',
                        success: function(data) {
                            if (data.status)
                            {
                                $('#error-msg').html(data.msg);
                                $('#error-div').removeClass('hide');
                                $('#submit-btn').removeAttr('disabled');
                            }
                            else
                            {
                                window.location.href = '/setting/biz';
                            }
                        }
                    });
                }

            </script>
        </div>

    </div><!--end .app-inner-->
</div><!--end .app-->

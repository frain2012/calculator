<?php
use yii\helpers\Html;


$this->title = '切换-商家中心';
?>
<style>
    ui,li{list-style: none;}
</style>
<div class="breadcrumb">
    <a href="/v2">首页</a>
    <span class="text-muted">/</span>
    <a href="/setting/shop">设置</a>
    <span class="text-muted">/</span>
    <span class="text-muted">门店管理</span>
</div>


<div class="app" style="">
    <div class="app-inner" style="">
        <?=Html::jsFile('@web/js/webuploader.min.js')?>
        <?=Html::cssFile('@web/css/webuploader.css')?>

        <div class="para-title"><h3>编辑公众号</h3></div>
        <div class="alert alert-warning" style=" margin-top: 10px">

            <p>
                <span class="text-warning">配置吸粉类型的营销活动(如砍价)时，从以下列表选择参与活动的公众号</span><br>
                <span class="text-warning">请确保您添加的认证公众号账号主体与好店通的签约公司名称一致，否则无法通过审核</span>
            </p>

        </div>

        <div class="row">

            <div class="col-sm-offset-2 col-sm-8 hide" id="error-div">

                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">出错了:</span>
                    <span id="error-msg"></span>
                </div>

            </div>
        </div>

        <div class="row" style="">

            <form class="form-horizontal" id="shop-home" style="">
                <input type="hidden" value="<?php if(!is_null($data)){echo $data->id;} ?>" id="id" name="id">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">公众号名称 <span style="color:red; font-size: 18px;">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="shop_name" name="name" value="<?php if(!is_null($data)){echo $data->name;} ?>">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">公众号</label>
                    <div class="col-sm-3" style="display: inline-block;">
                        <div class="uploader-demo">
                            <div id="uploadHeadImg">选择图片</div>
                        </div>
                        <span class="label label-warning ">图片宽度200px</span>
                        <div style="float:left; margin-right: 5px; text-align:center">
                            <input type="hidden" id="upload-button-0-input" name="qrcode" value="<?php if(!is_null($data)){echo $data->qrcode;}?>">
                            <img width="100px" height="100px" src="<?php if(!is_null($data)){echo $data->qrcode;}else{ echo '/images/photo_default.png';}?>" id="upload-button-0-img">
                        </div>

                    </div>
                </div>





                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary btn-lg" id="submit-btn" onclick="save();">保存</button>
                    </div>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            jQuery(function() {
                var uploader = WebUploader.create({
                    auto: true,
                    swf: '/js/Uploader.swf',
                    server: '/site/upload',
                    fileVal:'file',
                    pick: '#uploadHeadImg',
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
                        $( '#upload-button-0-input').val(response.url);
                        $( '#upload-button-0-img').attr({'src':response.url});
                    }
                });
            });




            function save()
            {
                $('#submit-btn').attr('disabled', true);
                $.ajax({
                    url: '/setting/mpedit',
                    type: 'post',
                    dataType: 'json',
                    data: $('#shop-home').serialize(),
                    success: function(data) {
                        if(data.status==0)
                        {
                            alert(data.msg);
                            window.location.href='/setting/mp'
                        }
                        else
                        {
                            $('#error-msg').html(data.msg);
                            $('#error-div').removeClass('hide');
                            $('#submit-btn').removeAttr('disabled');
                            window.location.href = '#error-div';
                        }
                    }
                });
            }
        </script>

    </div><!--end .app-inner-->
</div>

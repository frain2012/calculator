<?php
use yii\helpers\Html;


$this->title = '切换-商家中心';
?>
<style>
    ui,li{list-style: none;}
</style>
<div class="breadcrumb">
    <a href="/v2">合肥公众号</a>
    <span class="text-muted">/</span>
    <a href="/v2/plug">应用</a>
    <span class="text-muted">/</span>
    <a href="/v2/plug/ysfudai">集福袋(H5)</a>
    <span class="text-muted">/</span>
    <span class="text-muted">基础设置</span>
</div>


<div class="app" style="">
    <div class="app-inner" style="">
        <?=Html::jsFile('@web/js/webuploader.min.js')?>
        <?=Html::cssFile('@web/css/webuploader.css')?>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8 hide" id="error-div">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">出错了:</span>
                    <span id="error-msg"></span>
                </div>

            </div>
        </div>

        <div class="app-design clearfix" id="appDesign" style="padding-bottom: 0px;">
            <form class="form-horizontal" id="fudai-form">
                <div class="para-title">
                    <h3 class=""><span class="glyphicon glyphicon-picture"></span> 基础配置 <small>(必填)</small></h3>
                    <p class="para-title-side"><a data-toggle="collapse" href="#collapseBasic" aria-expanded="true" aria-controls="collapseBasic"><span class="glyphicon glyphicon-minus"></span> 收起</a></p>
                </div>
                <div class="collapse in" id="collapseBasic">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 活动列表标题</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="shop_name" name="name" value="<?php if(!is_null($data)){echo $data->name;}?>" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 联系人</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kf_name" name="telpeople" value="<?php if(!is_null($data)){echo $data->telpeople;}?>" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 联系电话</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="kf_tel" name="telphone" value="<?php if(!is_null($data)){echo $data->telphone;}?>" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"> 列表页头图</label>
                        <div class="col-sm-6">
                            <div class="uploader-demo">
                                <div id="uploadHeadImg">选择图片</div>
                            </div>
                            <small class="text-muted">上传640x320px图片</small>
                            <input type="hidden" id="sub_logo-0-input" name="headimg" value="<?php if(!is_null($data)){echo $data->headimg;}?>">
                            <p>
                                <img width="100px" height="50px" id="sub_logo-0-src" src="<?php if(!is_null($data)){echo $data->headimg;}?>">
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">分享头图</label>
                        <div class="col-sm-3" style="display: inline-block;">
                            <div class="uploader-demo">
                                <div id="uploadHeadImg1">选择图片</div>
                            </div>
                            <span class="label label-warning ">图片尺寸为 1080x864</span>
                            <div style="float:left; margin-right: 5px; text-align:center">
                                <input type="hidden" id="share_logo-0-input" name="shareimg" value="<?php if(!is_null($data)){echo $data->shareimg;}?>">
                                <img width="80px" id="share_logo-0-src" src="<?php if(!is_null($data)){echo $data->shareimg;}?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">分享标题</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="share_title" name="sharetitle" value="<?php if(!is_null($data)){echo $data->sharetitle;}?>" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">分享内容</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="share_content" name="sharedesc" value="<?php if(!is_null($data)){echo $data->sharedesc;}?>" placeholder="40个字以内">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-primary btn-langer" id="submit-btn" onclick="save();">保存</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="app-design-action text-center">
            </div>
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
                        $( '#sub_logo-0-input').val(response.url);
                        $( '#sub_logo-0-src').attr({'src':response.url});
                    }
                });
            });
            jQuery(function() {
                var uploader = WebUploader.create({
                    auto: true,
                    swf: '/js/Uploader.swf',
                    server: '/site/upload',
                    fileVal:'file',
                    pick: '#uploadHeadImg1',
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
                        $( '#share_logo-0-input').val(response.url);
                        $( '#share_logo-0-src').attr({'src':response.url});
                    }
                });
            });

            function save()
            {
                $('#submit-btn').attr('disabled', true);
                $.ajax({
                    url: '/plug/ysfudaiconfig',
                    type: 'post',
                    dataType: 'json',
                    data: $('#fudai-form').serialize(),
                    success: function(data) {
                        alert(data.msg);
                        if (data.status)
                        {
                            window.location.href = '/plug/ysfudaiconfig';
                        }
                        else
                        {
                            $('#error-msg').html(data.msg);
                            $('#error-div').removeClass('hide');
                            $('#submit-btn').removeAttr('disabled');
                        }
                    }
                });
            }
        </script>
    </div><!--end .app-inner-->
</div>

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
    <a href="/v2/setting">设置</a>
    <span class="text-muted">/</span>
    <span class="text-muted">门店管理</span>
</div>


<div class="app" style="">
    <div class="app-inner" style="">
        <?=Html::jsFile('@web/js/webuploader.min.js')?>
        <?=Html::cssFile('@web/css/webuploader.css')?>
        <?=Html::cssFile('@web/ueditor/themes/default/css/ueditor.css')?>
        <?=Html::jsFile('@web/ueditor/ueditor.config.js')?>
        <?=Html::jsFile('@web/ueditor/ueditor.all.min.js')?>

        <div class="para-title"><h3>编辑门店</h3></div>
        <div class="alert alert-warning col-sm-8 col-sm-offset-2" style=" margin-top: 10px">

            <p>
                <span class="text-warning">注意：带有</span><span style="color:red; font-size: 18px;">*</span><span class="text-warning">标记的表单项为必填项</span>
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
                    <label for="" class="col-sm-2 control-label">门店名 <span style="color:red; font-size: 18px;">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="shop_name" name="name" value="<?php if(!is_null($data)){echo $data->name;} ?>" placeholder="门店字号名称">
                    </div>
                </div>

                <!--<div class="form-group">
                    <label for="" class="col-sm-2 control-label">所在城市 <span style="color:red; font-size: 18px;">*</span></label>
                    <div class="col-sm-2" id="city-list"><select class="form-control" onchange="getCity($(this).val());" name="province_id">
                            <option value="0">=请选择=</option>
                        </select>
                    </div>
                </div>-->

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">电话 <span style="color:red; font-size: 18px;">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tel" name="tel" value="<?php if(!is_null($data)){echo $data->tel;} ?>" placeholder="门店电话(方便客人联系)">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">logo</label>
                    <div class="col-sm-3" style="display: inline-block;">
                        <div class="uploader-demo">
                            <div id="uploadHeadImg">选择图片</div>
                        </div>
                        <span class="label label-warning ">请上传100*100的头像</span>
                        <div style="float:left; margin-right: 5px; text-align:center">
                            <input type="hidden" id="upload-button-0-input" name="logo" value="<?php if(!is_null($data)){echo $data->logo;}?>">
                            <img width="100px" height="100px" src="<?php if(!is_null($data)){echo $data->logo;}else{ echo '/images/photo_default.png';}?>" id="upload-button-0-img">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">微信客服</label>
                    <div class="col-sm-4">
                        <div class="uploader-demo">
                            <div id="uploadHeadImg1">选择图片</div>
                        </div>
                        <div>
                            <input type="hidden" id="upload-button1-0-input" name="kefu" value="<?php if(!is_null($data)){echo $data->kefu;}?>">
                            <img width="100px" height="100px" src="<?php if(!is_null($data)){echo $data->kefu;}else{ echo '/images/photo_default.png';}?>" id="upload-button1-0-img">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">相册照片</label>
                    <div class="col-sm-4" style="display: inline-block;">
                        <div class="uploader-demo">
                            <div id="uploadHeadImg2">选择图片</div>
                        </div>
                        <div style="float:left; margin-right: 5px; margin-top: 5px;">
                            <span class="label label-warning ">规格:640*320px</span>
                            <div style="float:left; margin-right: 5px; text-align:center;position:relative;">
                                <input type="hidden" id="upload-btn-banner1-0-input" name="imgs" value="<?php if(!is_null($data)){echo $data->imgs;}?>">
                                <img width="100px" height="100px" src="<?php if(!is_null($data)){echo $data->imgs;}else{ echo '/images/photo_default.png';}?>" id="upload-btn-banner1-0-img">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group" style="">
                    <label for="" class="col-sm-2 control-label">商家介绍</label>

                    <div class="col-sm-8" style="">
                        <script id="editor" type="text/plain" style="width:1024px;height:500px;" name="content">
                            <?php if(!is_null($data)){echo $data->content;}?>
                        </script>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">开启核销收款密码 <span style="color:red; font-size: 18px;">*</span></label>
                    <div class="radio">
                        <label style="padding-left:35px;padding-right:15px">
                            <input type="radio" name="is_passwd" value="1" onchange="changePass(0);" <?php if(!is_null($data) && $data->is_passwd==1){echo "checked='checked'";}?>>否
                        </label>

                        <label>
                            <input type="radio" name="is_passwd" value="2" onchange="changePass(1);" <?php if(!is_null($data) && $data->is_passwd==2){echo "checked='checked'";}?>>是
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <font style="padding-left:15px;" class=" text-warning">如果您的业务涉及到支付收单、微信会员卡买单功能，建议您开启密码验证</font>
                </div>

                <div id="password-set" <?php if(!is_null($data) && $data->is_passwd==2){echo "";}else{ echo "style='display:none'";}?>>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">密码 <span style="color:red; font-size: 18px;">*</span></label>
                        <div class="input-group col-sm-8" style="padding-left:15px;padding-right:15px">
                            <input type="text" class="form-control" id="password" name="passwd" value="<?php if(!is_null($data)){echo $data->passwd;}?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">联系地址 <span style="color:red; font-size: 18px;">*</span></label>
                    <div class="col-sm-5">
                        <input type="hidden" name="lat" value="" id="map_lat">
                        <input type="hidden" name="lng" value="" id="map_lng">
                        <input type="text" class="form-control" id="mapSearchKeyword" name="addr" value="<?php if(!is_null($data)){echo $data->addr;}?>" placeholder="" style="">
                    </div>
                    <div class="col-sm-2">
                        <input type="button" class="btn btn-success btn-block" value="搜索" onclick="searchMap($('#mapSearchKeyword').val(),1);">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <font style="padding-left:15px;" class=" text-warning">输入联系地址之后请记得点击【搜索】定位门店所在位置</font>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>

                </div>



                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary btn-lg" id="submit-btn" onclick="save();">保存</button>
                    </div>
                </div>

            </form>

        </div>

        <script type="text/javascript">

            $(document).ready(function() {
                var editor;
                editor = new baidu.editor.ui.Editor({toolbars:[
                    ['FullScreen', 'Source', '|', 'Undo', 'Redo', '|',
                        'Bold', 'Italic', 'Underline', 'StrikeThrough', 'RemoveFormat', 'FormatMatch','AutoTypeSet', '|',
                        'BlockQuote', '|', 'PastePlain', '|', 'ForeColor', 'BackColor', 'InsertOrderedList', 'InsertUnorderedList', '|','RowSpacingTop', 'RowSpacingBottom','LineHeight', '|','FontFamily', 'FontSize', '|',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyJustify', '|',
                        'Link', 'Unlink', 'Anchor', '|', 'ImageNone', 'ImageLeft', 'ImageRight', 'ImageCenter', '|', 'InsertImage']], initialFrameWidth:600,initialFrameHeight:350,
                    topOffset:0
                });
                editor.render("editor");
            });
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
                        $( '#upload-button1-0-input').val(response.url);
                        $( '#upload-button1-0-img').attr({'src':response.url});
                    }
                });
            });
            jQuery(function() {
                var uploader = WebUploader.create({
                    auto: true,
                    swf: '/js/Uploader.swf',
                    server: '/site/upload',
                    fileVal:'file',
                    pick: '#uploadHeadImg2',
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
                        $( '#upload-btn-banner1-0-input').val(response.url);
                        $( '#upload-btn-banner1-0-img').attr({'src':response.url});
                    }
                });
            });

            function changePass(v)
            {
                if (v == 0)
                {
                    $('#password-set').hide();
                }
                else if (v==1)
                {
                    $('#password-set').show();
                }
            }

            function check_value() {
                if ($('#shop_name').val() == '') {
                    alert('请填写门店名称');
                    return false;
                }
            }

            function appendSrc()
            {

            }

            function getCity(cid)
            {
                $.ajax({
                    url: '/city',
                    type: 'get',
                    data: {
                        cid: cid
                    },
                    success: function(data) {
                        $('#city-list').html(data);
                    }
                });
            }


            function save()
            {
                $('#submit-btn').attr('disabled', true);
                $.ajax({
                    url: '/setting/shopedit',
                    type: 'post',
                    dataType: 'json',
                    data: $('#shop-home').serialize(),
                    success: function(data) {
                        if(data.status==0)
                        {
                            alert(data.msg);
                            window.location.href='/setting/shop'
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

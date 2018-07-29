<?php
use yii\helpers\Html;


$this->title = '切换-商家中心';
?>
<style>
    ui,li{list-style: none;}
</style>
<div class="breadcrumb">
    <a href="/v2"> 指尖合肥</a>
    <span class="text-muted">/</span>
    <a href="/v2/plug">应用</a>
    <span class="text-muted">/</span>
    <span class="text-muted">设置独立域名</span>
</div>

<div class="app">
    <div class="app-inner">

        <div class="app">

            <div class="tab-content">
                <div>
                    <a target="_blank" class="btn btn-success" onclick="showServiceMdl()">配置公众号</a>
                    <a href="javascript:loadMoneyNotify('')" class="btn btn-primary">添加域名</a>
                    <small class="text-danger">请先根据【<a href="https://pan.baidu.com/s/1-u5XyKm_h1DnjsPlGpWvdA" target="_blank">配置文档</a>】做好相关的配置</small>
                    <br>
                    <br>
                </div>

                <table class="table table-hover table-bordered table-striped">
                    <form id="order-form"></form>
                    <input type="hidden" name="action" value="order">
                    <tbody><tr>
                        <th>域名</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    <?php if(!is_null($model)){ foreach($model as $item) { ?>
                        <tr>
                            <td><?= $item->domain;?></td>
                            <td>
                                <?php
                                    switch ($item->status) {
                                        case "2":
                                            echo "<span class='label label-info'>备用</span>";
                                            break;
                                        case "99":
                                            echo "<span class='label label-info'>分享域名</span>";
                                            break;
                                        case "0":
                                            echo "<span class='label label-success'>使用中</span>";
                                            break;
                                        case "-1":
                                            echo "<span class='label label-danger'>封禁</span>";
                                            break;
                                        case "-2":
                                            echo "<span class='label label-danger'>删除</span>";
                                            break;
                                    }
                                ?>
                            </td>
                            <td>
                                <a onclick="loadMoneyNotify('<?= $item->domain;?>');">编辑</a>
                                <?php
                                    if($item->status !=0){
                                        echo '&nbsp;<a onclick="update('.$item->id.', 0);">设置为业务域名</a>';
                                    }
                                    if($item->status !=-1){
                                        echo '&nbsp;<a onclick="update('.$item->id.', -1);">标记封禁</a>';
                                    }
                                    if($item->status !=99){
                                        echo '&nbsp;<a onclick="update('.$item->id.', 99);">设置为分享域名</a>';
                                    }
                                    if($item->status<=0){
                                        echo '&nbsp;<a onclick="update('.$item->id.', 22);">设置备用</a>';
                                    }
                                ?>
                                <a onclick="update('<?= $item->id;?>', -2);">删除</a>
                            </td>
                        </tr>
                    <?php } }?>
                    </tbody></table>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_domain_dl">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header modal-header-tab">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">设置域名</h4>
                    </div>

                    <div class="modal-body" id="form-wrapper">
                        <form class="form-horizontal" id="domain_form">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">域名</label>
                                <input type="hidden" name="action" value="save_domain">
                                <div class="col-sm-10 input-group" style="padding-left:15px;padding-right:15px">
                                    <input type="text" class="form-control" id="domain" name="domain" required="">
                                </div>
                                <small class="text-danger" style="padding-left:50px;padding-right:15px">*请填写您购买一级域名或者域名下的二级域名(例如:xxx.com或者a.xxx.com,b.xxx.com),并确保域名已根据【<a href="https://pan.baidu.com/s/1-u5XyKm_h1DnjsPlGpWvdA" target="_blank">配置文档</a>】做域名解析，否则活动将无法正常访问</small>
                                <br>
                                <small class="text-danger" style="padding-left:50px;padding-right:15px">*配置完成之后，请按照文档中的第3步跟第5步进行操作</small>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="save_domain()">保存</button>
                    </div>

                </div><!--end .modal-content-->
            </div><!--end .modal-dialog-->
        </div><!--end .modal-->

        <div class="modal fade" tabindex="-1" role="dialog" id="add_service_mdl">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header modal-header-tab">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">公众号配置</h4>

                    </div>

                    <div class="modal-body" id="form-wrapper">
                        <form class="form-horizontal" id="save_mp_form" method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">公众号名称</label>
                                <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                    <input type="text" class="form-control" id="remark" name="remark" value="<?php if(!is_null($data)){echo $data->name;} ?>" required="">
                                    <small class="text-danger">*请填写公众号名称</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">公众号APPID</label>
                                <input type="hidden" name="action" value="save_mp">
                                <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                    <input type="text" class="form-control" id="app_id" name="app_id" value="<?php if(!is_null($data)){echo $data->appid;} ?>" required="">
                                    <small class="text-danger">*请填写公众号APPID(从微信公众号后台 基础配置 获得)</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">公众号APPSECRET</label>
                                <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                    <input type="text" class="form-control" id="app_secret" name="app_secret" value="<?php if(!is_null($data)){echo $data->appsecret;} ?>" required="">
                                    <small class="text-danger">*请填写公众号APPID(从微信公众号后台 基础配置 获得)</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">授权txt文件名</label>
                                <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                    <input type="text" class="form-control" id="file_name" name="file_name" value="<?php if(!is_null($data)){echo $data->auth;} ?>" required="">
                                    <small class="text-danger">*例如(MP_verify_************.txt)</small>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="save_mp()">保存</button>
                    </div>

                </div><!--end .modal-content-->
            </div><!--end .modal-dialog-->
        </div><!--end .modal-->

        <script type="text/javascript" language="javascript">
            function save_mp(){
                var remark = $("#remark").val();
                var app_id = $("#app_id").val();
                var app_secret = $("#app_secret").val();
                var file_name = $("#file_name").val();

                if(!remark){
                    alert('公众号不能为空!');
                    return false;
                }
                if(!app_id){
                    alert('公众号appid不能为空!');
                    return false;
                }
                if(!app_secret){
                    alert('公众号appsecret不能为空!');
                    return false;
                }
                if(!file_name){
                    alert('文件名称不能为空!');
                    return false;
                }

                $.ajax({
                    url: '/setting/domain',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        action:"config",
                        name:remark,
                        appid:app_id,
                        appsecret:app_secret,
                        auth:file_name
                    },
                    success: function(data) {
                        alert(data.msg);
                        if (data.status)
                        {
                            location.reload();
                        }
                    }
                });

            }
            function showServiceMdl(){
                $("#add_service_mdl").modal("show");
            }
            function update(id, status)
            {
                var msg = '';
                if (status == '0')
                {
                    msg = '确认启用?';
                }
                else if (status == '-1')
                {
                    msg = '设置封禁?';
                }else if(status == '99'){
                    msg = '只需要设置一个分享域名，确认设置?';
                }else if(status == -2){
                    msg = '确认删除？';
                }
                else{
                    status =2;
                    msg = '设置备用?';
                }

                if (confirm(msg))
                {
                    $.ajax({
                        url: '/setting/domain',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: id,
                            action:"set_status",
                            status: status
                        },
                        success: function(data)
                        {
                            alert(data.msg);
                            location.href = location.href;
                        }
                    });
                }
            }
            function loadMoneyNotify(domain){
                $("#domain").val(domain);
                $("#edit_domain_dl").modal('show');
            }

            function save_domain()
            {
                $('#submit-btn').attr('disabled', true);
                $.ajax({
                    url: '/setting/domain',
                    type: 'post',
                    dataType: 'json',
                    data: $('#domain_form').serialize(),
                    success: function(data) {
                        alert(data.msg);
                        location.href = location.href;
                    }
                });
            }
        </script>


    </div><!--end .app-inner-->
</div>
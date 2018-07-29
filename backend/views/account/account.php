<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = '账号中心';
?>
<div class="breadcrumb">
    <a href="javascript:;"> 账号</a>
</div>

<div class="app">
    <div class="app-inner">

        <div class="app">

            <div class="tab-content">
                <div>
                    <a target="_blank" class="btn btn-success" onclick="showServiceMdl()">增加</a>
                    <br>
                    <br>
                </div>

                <table class="table table-hover table-bordered table-striped">
                    <tbody><tr>
                        <th>账号</th>
                        <th>操作</th>
                    </tr>
                    <?php if(!is_null($model)){ foreach($model as $item) { ?>
                        <tr>
                            <td><?= $item->tel;?></td>
                            <td>
                                <a onclick="loadMoneyNotify('<?= $item->id;?>','<?= $item->tel;?>');">修改密码</a>
                                &nbsp;&nbsp;&nbsp;
                                <a onclick="del('<?=$item->id;?>');">删除</a>
                            </td>
                        </tr>
                    <?php } }?>
                    </tbody>
                </table>
                <nav class="text-center">
                    <?= LinkPager::widget(['pagination' => $paegs]); ?>
                </nav>
            </div>
        </div>
    </div><!--end .app-inner-->

    <div class="modal fade" tabindex="-1" role="dialog" id="add_service_mdl">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header modal-header-tab">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">配置</h4>
                </div>

                <div class="modal-body" id="form-wrapper">
                    <form class="form-horizontal" id="save_mp_form" method="post">
                        <div class="form-group">
                            <input type="hidden" id="id" name="id" value=""/>
                            <label for="" class="col-sm-2 control-label">账号</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="tel" name="tel" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="pwd" name="pwd" value=""/>
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
</div>
<script>
    function showServiceMdl(){
        $("#id").val("");
        $("#tel").removeAttr("disabled");
        $("#add_service_mdl").modal("show");
    }
    function save_mp(){
        $.ajax({
            url: '/account/add',
            type: 'post',
            dataType: 'json',
            data: $('#save_mp_form').serialize(),
            success: function(data) {
                alert(data.msg);
                $("#add_service_mdl").modal("hide");
            }
        });
    }
    function del(id) {
        if (confirm("确认删除？")){
            $.ajax({
                url: '/account/adel',
                type: 'post',
                dataType: 'json',
                data: {'id':id},
                success: function(data) {
                    alert(data.msg);
                }
            });
        }
    }
    function loadMoneyNotify(id,tel) {
        $("#id").val(id);
        $("#tel").attr({"disabled":"disabled"});
        $("#tel").val(tel);
        $("#add_service_mdl").modal("show");
    }
</script>

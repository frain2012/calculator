<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = '配置中心';
?>
<div class="breadcrumb">
    <a href="/v2"> 设置</a>
</div>

<div class="app">
    <div class="app-inner">

        <div class="app">

            <div class="tab-content">
                <div>
                    <a target="_blank" class="btn btn-success" onclick="showServiceMdl()">配置</a>
                    <br>
                    <br>
                </div>

                <table class="table table-hover table-bordered table-striped">
                    <tbody><tr>
                        <th>年份</th>
                        <th>城镇居民人均可支配收入</th>
                        <th>城镇居民人均消费性支出</th>
                        <th>农村居民人均可支配收入</th>
                        <th>农村居民人均消费性支出</th>
                        <th>平均工资</th>
                        <th>生效时间</th>
                        <th>操作</th>
                    </tr>
                    <?php if(!is_null($model)){ foreach($model as $item) { ?>
                        <tr>
                            <td><?= $item->year;?></td>
                            <td><?= $item->town_dis_income;?></td>
                            <td><?= $item->town_con_income;?></td>
                            <td><?= $item->area_dis_income;?></td>
                            <td><?= $item->area_con_income;?></td>
                            <td><?= $item->avg_wage;?></td>
                            <td><?= $item->eff_date;?></td>
                            <td>
                                <a onclick="loadMoneyNotify('<?= $item->id;?>','<?= $item->year;?>','<?= $item->town_dis_income;?>','<?= $item->town_con_income;?>','<?= $item->area_dis_income;?>','<?= $item->area_con_income;?>','<?= $item->avg_wage;?>','<?= $item->eff_date;?>');">编辑</a>
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
                            <label for="" class="col-sm-2 control-label">年份</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="year" name="year" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">城镇居民人均可支配收入</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="town_dis_income" name="town_dis_income" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">城镇居民人均消费性支出</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="town_con_income" name="town_con_income" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">农村居民人均可支配收入</label>
                            <input type="hidden" name="action" value="save_mp">
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="area_dis_income" name="area_dis_income" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">农村居民人均消费性支出</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="area_con_income" name="area_con_income" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">平均工资</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="avg_wage" name="avg_wage" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">生效日期</label>
                            <div class="col-sm-10" style="padding-left:15px;padding-right:15px">
                                <input type="text" class="form-control" id="eff_date" name="eff_date" value=""/>
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
        $("#add_service_mdl").modal("show");
    }
    function save_mp(){
        $.ajax({
            url: '/account/save',
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
                url: '/account/del',
                type: 'post',
                dataType: 'json',
                data: {'id':id},
                success: function(data) {
                    alert(data.msg);
                }
            });
        }
    }
    function loadMoneyNotify(id,year,town_dis_income,town_con_income,area_dis_income,area_con_income,avg_wage,eff_date) {
        $("#id").val(id);
        $("#year").val(year);
        $("#town_dis_income").val(town_dis_income);
        $("#town_con_income").val(town_con_income);
        $("#area_dis_income").val(area_dis_income);
        $("#area_con_income").val(area_con_income);
        $("#avg_wage").val(avg_wage);
        $("#eff_date").val(eff_date);
        $("#add_service_mdl").modal("show");
    }
</script>

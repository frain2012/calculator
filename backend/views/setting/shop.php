<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = '切换-商家中心';
?>
    <div class="breadcrumb">
        <a href="/v2">首页</a>
        <span class="text-muted">/</span>
        <a href="/v2/setting">设置</a>
        <span class="text-muted">/</span>
        <span class="text-muted">门店管理</span>
    </div>


    <div class="app">
        <div class="app-inner">


            <div class="clearfix">
                <form class="form-inline" method="get">
                    <div class="form-group">
                        <label for="" class="control-label">门店名称:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="门店名称关键字">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default pull-right" type="submit">搜索</button>
                    </div>

                    <div class="form-group"><a href="/setting/shopedit" class="btn btn-primary">新增门店</a></div>
                </form>
            </div>
            <hr>

            <div class="row">
                    <?php if(!is_null($model)){ foreach($model as $item){?>
                        <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>
                                    <?=$item->name;?>
                                    <small class="label label-success pull-right">
                                        <?php if (!is_null($item->status)){
                                        switch ($item->status){
                                            case 1:
                                                echo '正常';
                                                break;
                                            case 2:
                                                echo '下架';
                                                break;
                                            default:
                                                echo '未知';
                                                break;
                                        }   }?>
                                    </small>
                                </h4>
                                <p>地址：<?=$item->addr;?></p>
                                <p>电话：<?=$item->tel;?></p>

                                <div class="row">
                                    <div class="col-sm-10"><p>核销地址：<a href="http://d.tcquan.cn/chargeoff?en=6374f32bca" target="_blank">http://d.tcquan.cn/chargeoff?en=6374f32bca</a></p></div>
                                    <div class="col-sm-2">

                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                链接二维码
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="text-center">
                                                    <small class="text-success">手机扫一扫</small>
                                                    <p><img src="" alt="" style="width:120px;"></p>
                                                </li>
                                                <li class="action-divider"></li>
                                                <li class="text-center"><a href="javascript:;" class="copy-text" data-clip="http://d.tcquan.cn/chargeoff?en=6374f32bca">复制页面链接</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10"><p>微信主页：<a href="http://m.tcquan.cn/to/tcq/0/shop/13470" target="_blank">http://m.tcquan.cn/to/tcq/0/shop/13470</a></p></div>
                                    <div class="col-sm-2">
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                链接二维码
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="text-center">
                                                    <small class="text-success">微信扫一扫</small>
                                                    <p><img src="" alt="" style="width:120px;"></p>
                                                </li>
                                                <li class="action-divider"></li>
                                                <li class="text-center"><a href="javascript:;" class="copy-text" data-clip="http://m.tcquan.cn/to/tcq/0/shop/13470">复制页面链接</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <a class="btn btn-danger" href="javascript:void(0);" onclick="update('<?=$item->id;?>', <?=3-$item->status;?>);" role="button">
                                    <?php if (!is_null($item->status)){
                                        switch ($item->status){
                                            case 1:
                                                echo '下架';
                                                break;
                                            case 2:
                                                echo '上架';
                                                break;
                                            default:
                                                echo '未知';
                                                break;
                                        }   }?>
                                </a>
                                <a class="btn btn-default" href="/setting/shopedit?hbid=<?=$item->id;?>" role="button">编辑</a>
                            </div>
                        </div>
                    </div>
                    <?php } }?>





            </div>
            <nav class="text-center">
                <?= LinkPager::widget(['pagination' => $pages]); ?>
<!--                <ul class="pagination">-->
<!--                    <li class="disabled"><a href="javascript:void(0)">共1条</a></li>-->
<!--                    <li class="active"><a href="/v2/setting/shop?page=1">1</a></li>-->
<!--                </ul>-->
            </nav>


            <!--<div class="modal fade" id="modalStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">同步支付宝门店</h4>
                        </div>
                        <div class="modal-body">
                            <p class="clearfix page-header">
                                <a href="javascript:void(0);" onclick="checkAll(1);" class="pull-left">全选</a>
                                <a href="javascript:void(0);" onclick="checkAll(0);" class="pull-right">全不选</a>
                            </p>
                            <div class="row">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" onclick="syncshop();" id="shop-btn" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                </div>
            </div>-->


            <div class="modal fade" id="modalStore1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">关键门店1</h4>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="check_shop_id" value="">
                            <div class="row">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" onclick="bind();" id="shop-btn" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript" language="javascript">
                function update(shop_id, status) {
                    var msg = '';
                    if (status == '1')
                    {
                        msg = '确认下架?';
                    }
                    else if (status == '2')
                    {
                        msg = '确认上架?';
                    }
                    if (confirm(msg)) {
                        $.ajax({
                            url: '/setting/shopstatus',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                id: shop_id,
                                status: status
                            },
                            success: function(data) {
                                alert(data.msg);
                                if (data.status==0) {
                                    window.location.href = '/setting/shop';
                                }
                            }
                        });
                    }
                }

                function createqr(shop_id)
                {
                    $.ajax({
                        url: '/v2/setting/shop',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: shop_id
                        },
                        success: function(data) {
                            alert(data.msg);
                            if (data.status) {
                                window.location.href = '/v2/setting/shop';
                            }
                        }
                    });
                }

                function syncshop()
                {
                    $('#shop-btn').attr('disabled', true);
                    var arr = [];
                    $("input[name='shopcheckbox']:checked").each(function() {
                        arr.push($(this).val());
                    });
                    if (arr.length == 0) {
                        alert('未选中任何门店');
                        return;
                    }

                    if (!confirm('确认同步?')) {
                        return false;
                    }
                    $.ajax({
                        url: '/v2/setting/shop/syncali',
                        type: 'post',
                        dataType: 'json',
                        data: {shop_id:arr},
                        success: function(data) {
                            alert(data.msg);
                            if (data.status)
                            {
                                window.location.reload();
                            }
                            else
                            {
                                $('#shop-btn').removeAttr('disabled');
                            }
                        }
                    });
                }

                function bind()
                {

                    $('#shopbind-btn').attr('disabled', true);
                    var shop_id = $("input[name='shopbindcheckbox']:checked").val();
                    if (!shop_id) {
                        alert('未选择任何门店');
                        return;
                    }
                    if (!confirm('确认同步?')) {
                        return false;
                    }
                    $.ajax({
                        url: '/v2/setting/shop/bindshop',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            ali_shop_id:shop_id,
                            id:$('#check_shop_id').val()
                        },
                        success: function(data) {
                            alert(data.msg);
                            if (data.status)
                            {
                                window.location.reload();
                            }
                            else
                            {
                                $('#shopbind-btn').removeAttr('disabled');
                            }
                        }
                    });
                }

            </script>


            <script src="//cdn.bootcss.com/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
            <script type="text/javascript">
                var client = new ZeroClipboard( $('.copy-text') );

                client.on( 'ready', function(event) {

                    client.on( 'copy', function(event) {
                        event.clipboardData.setData('text/plain', $(event.target).data('clip'));
                    } );

                    client.on( 'aftercopy', function(event) {
                        alert('链接已复制到剪贴板')
                    } );
                } );

                client.on( 'error', function(event) {
                    ZeroClipboard.destroy();
                } );




            </script>

        </div><!--end .app-inner-->
    </div><!--end .app-->

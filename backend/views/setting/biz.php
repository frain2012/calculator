<?php
use yii\helpers\Html;


$this->title = '切换-商家中心';
?>
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
            <form class="form-horizontal">

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">公司名:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><?=$data->company?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">品牌名:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><?=$data->brand?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">品牌Logo:</label>
                    <div class="col-sm-8">
                        <img width="100px" id="brand_logo-0-src" src="<?=$data->logo?>">
                    </div>
                </div>



                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">微信主页:</label>
                    <div class="col-sm-8">

                        <div class="form-control-static">
                            <a href="http://m.tcquan.cn/to/tcq/0/biz/1817/shoplist">http://m.tcquan.cn/to/tcq/0/biz/1817/shoplist</a>
                            <div class="btn-group btn-group-xs" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    链接二维码
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="text-center">
                                        <small class="text-success">手机扫一扫</small>
                                        <p><img src="/v2/qr?text=http%3A%2F%2Fm.tcquan.cn%2Fto%2Ftcq%2F0%2Fbiz%2F1817%2Fshoplist" alt="" style="width:120px;"></p>
                                    </li>
                                    <li class="action-divider"></li>
                                    <li class="text-center"><a href="javascript:;" class="copy-text" data-clip="http://m.tcquan.cn/to/tcq/0/biz/1817/shoplist">复制页面链接</a></li>
                                </ul>
                            </div>

                        </div>

                    </div>


                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <a href="/setting/biz?edit&amp;hbid=<?=$hbid;?>" class="btn btn-primary">编辑</a>
                    </div>
                </div>
            </form>


        </div>
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


            function delbiz(){
                var con = confirm('确定删除?');
                if(con){
                    var id = '1817';
                    $.ajax({
                        url: '/v2/setting/biz?del',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            id:id,
                        },
                        success: function(data) {
                            if (data.status==0)
                            {
                                window.location.reload();
                            }else{
                                alert(data.msg);
                            }
                        }
                    });
                }
            }

        </script>

    </div><!--end .app-inner-->
</div><!--end .app-->

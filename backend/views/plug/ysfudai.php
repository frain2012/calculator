<?php
use yii\helpers\Html;

$this->title = '切换-商家中心';
?>
<div class="breadcrumb">
    <a href="/v2">合肥公众号</a>
    <span class="text-muted">/</span>
    <a href="/v2/plug">应用</a>
    <span class="text-muted">/</span>
    <span class="text-muted">集福袋(H5)</span>
</div>


<div class="app">
    <div class="app-inner">
        <?=Html::jsFile('@web/js/WdatePicker.js')?>
        <?=Html::cssFile('@web/css/WdatePicker.css')?>
        <div class="jumbotron">
            <div class="caption media">
                <div class="media-left"><span class="media-object avatar-text avatar-danger">集</span></div>
                <div class="media-body">
                    <h4 class="media-heading">集福袋(H5)</h4>
                    <p class="media-desc">集福袋，赢奖品，可引导用户转发和关注。</p>
                    <p>开通时间：2018年05月03日（不能继续开通）</p>
                </div>

            </div>

        </div>

        <div class="tab-content">
            <div class="page-header clearfix" style=" margin-top: 5px;">
                <div class="pull-left col-md-10">
                    <form class="form-inline" method="get">
                        <div class="form-group">
                            <label for="" class="control-label">活动名称:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="title" name="title" value="<?php if(!is_null($title)){echo $title;} ?>" placeholder="活动名称关键字">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label">状态:</label>
                            <div class="input-group">
                                <select name="status" class="form-control">
                                    <option value="-1">=全部=</option>
                                    <option value="0" <?php if(!is_null($status) && ($status=="0")){echo "selected";} ?> >正常</option>
                                    <option value="1" <?php if(!is_null($status) && ($status=="1")){echo "selected";} ?>>禁用</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="搜索" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="pull-right col-md-2 text-right">
                    <a href="/plug/ysfudaiedit" class="btn btn-sm btn-success">创建活动</a>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active" id="all">
                <table class="table">
                    <colgroup>
                        <col width="30%">
                        <col width="20%">
                        <col width="8%">
                        <col width="">
                    </colgroup>
                    <thead>
                    <tr class="table-row-title">
                        <td class="text-center">名称</td>
                        <td class="text-center">时间</td>
                        <td class="text-center">状态</td>
                        <td class="text-center">操作</td>
                    </tr>
                    </thead>

                    <?php if(!is_null($model)){ foreach($model as $item){?>

                    <tbody class="table-noborder">
                    <tr>
                        <td><?=$item->name;?></td>
                        <td class="text-center"><span class="text-muted">从</span><?=$item->start;?><br><span class="text-muted">至</span><?=$item->end;?></td>
                        <td class="text-center" style="width:10%;">
                            <?php if (!is_null($item->stauts)){
                                switch ($item->stauts){
                                    case 1:
                                        echo '<span class="label label-success">正常</span>';
                                        break;
                                    case 2:
                                        echo '<span class="label label-warn">禁用</span>';
                                        break;
                                    default:
                                        echo '未知';
                                        break;
                                }   }?>

                        </td>
                        <td class="text-left">
                            <span class="dropdown">
                                <a href="javascript:" data-toggle="dropdown">预览<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="text-center">
                                        <small class="text-success">手机扫码访问</small>
                                        <p><img src="/v2/qr?text=http%3A%2F%2Fm.xxiaodian.cn%2Ft%2Fysfudai%3Fbiz_id%3D9481%26en%3D25cfc27033" alt="" style="width:120px;" id="wx_url_136_qr"></p>
                                    </li>
                                    <li class="action-divider"></li>
                                    <li class="text-center"><a class="copy-me" data-clip="http://m.xxiaodian.cn/t/ysfudai?biz_id=9481&amp;en=25cfc27033" href="javascript:;">复制页面链接</a></li>
                                </ul>
                            </span>
                            <span class="action-divider">|</span>
                            <a href="javascript:;" onclick="getData(136)"><span>数据概况</span><span class="caret"></span></a>
                            <span class="action-divider">|</span>
                            <a href="javascript:" onclick="showMpList('25cfc27033')">获取公众号链接</a>
                            <span class="action-divider">|</span>
                            <a href="/plug/ysfudaiitemlist?id=<?=$item->id;?>">参与记录</a>
                            <span class="action-divider">|</span>
                            <br>
                            <a href="/plug/ysfudaiitemlist?id=<?=$item->id;?>&amp;is_finished=1&amp;code_status=-1">完成记录</a>
                            <span class="action-divider">|</span>
                            <a href="/plug/ysfudaiedit?id=<?=$item->id;?>">修改</a>
                            <span class="action-divider">|</span>
                            <a onclick="update('136', <?=$item->id;?>);" href="javascript:;">禁用</a>
                        </td>
                    </tr>

                    <tr class="collapse data_form_show" id="data-136">
                        <td colspan="4">
                            <ul class="overview" id="data_loading-136">
                                <li class="text-muted text-center"><span class="glyphicon glyphicon-cog" hdtrole="load"></span> 正在加载...</li>
                            </ul>
                            <div id="data_form-136"></div>
                        </td>
                    </tr>

                    </tbody>
                    <?php } }?>

                </table>
            </div>
        </div>

        <nav class="text-center"><ul class="pagination"><li class="disabled"><a href="javascript:void(0)">共2条</a></li><li class="active"><a href="/v2/plug/ysfudai?page=1">1</a></li></ul></nav>
        <div class="modal fade in" tabindex="-1" role="dialog" id="applink">
        </div>

        <div class="modal fade in" tabindex="-1" role="dialog" id="fudai_Info">
        </div>

        <script src="//cdn.bootcss.com/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
        <script type="text/javascript">
            var client = new ZeroClipboard( $('.copy-me') );
            //这里的.copy-text可以是a或p或span标签上的class

            client.on( 'ready', function(event) {
                client.on( 'copy', function(event) {
                    var target = $(event.target).data('target');
                    if(target) {
                        var text = $(target).text();
                    } else {
                        var text = $(event.target).data('clip');
                    }
                    event.clipboardData.setData('text/plain', text);
                } );

                client.on( 'aftercopy', function(event) {
                    //alert('已复制到剪贴板')
                } );
            } );

            client.on( 'error', function(event) {
                ZeroClipboard.destroy();
            } );
        </script>


        <script>
            function update(fudai_id, status)
            {
                var msg = '';
                if (status == '0')
                {
                    msg = '确认启用?';
                }
                else if (status == '1')
                {
                    msg = '确认禁用?';
                }
                else if (status == -1)
                {
                    msg = '确认删除？';
                }
                if (confirm(msg))
                {
                    $.ajax({
                        url: '/v2/plug/ysfudai',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            action:'update',
                            id: fudai_id,
                            status: status
                        },
                        success: function(data)
                        {
                            alert(data.msg);
                            if (data.status)
                            {
                                window.location.href = '/plug/ysfudai';
                            }
                        }
                    });
                }
            }

            function showMpList(fudai_en){
                $.ajax({
                    url: '?Getmplist',
                    type: 'get',
                    dataType: 'html',
                    data: {
                        fudai_en:fudai_en
                    },
                    success: function(data) {
                        $("#applink").modal();
                        $("#applink").html(data);
                    }
                });

            }

            function getData(fudai_id){
                $("#data_form_show").hide();

                $("#data_loading-"+fudai_id).show();
                $("#data-"+fudai_id).show();

                $.ajax({
                    url: '/plug/ysfudai',
                    type: 'get',
                    dataType: 'html',
                    data: {
                        getdata:'',
                        fudai_id:fudai_id
                    },
                    success: function(data) {
                        $("#data_form-"+fudai_id).html(data);
                        $("#data_loading-"+fudai_id).hide();
                    }
                });

            }
        </script>
    </div><!--end .app-inner-->
</div>

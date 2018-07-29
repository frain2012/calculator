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
    <span class="text-muted">微信菜单管理</span>
</div>


<div class="app">
    <div class="app-inner">

        <div class="row">
            <form class="form-horizontal" method="post" id="menu-form">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">菜单1:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-1" maxlength="7" class="form-control" value="" placeholder="一级菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-1" class="form-control" id="menu-type-1" onchange="changeType($(this).val(),'1');">
                                <option value="view" selected="">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>

                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-1" class="form-control" placeholder="链接地址或者按钮的key" value="">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div><!-- /.row -->
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单1:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-1-1" maxlength="10" value="" class="form-control" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-1-1" onchange="changeType($(this).val(),'1-1');" class="form-control" id="menu-type-1-1">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-1-1" class="form-control" value="" placeholder="链接地址或者按钮的key">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单2:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-1-2" maxlength="10" value="" class="form-control" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-1-2" onchange="changeType($(this).val(),'1-2');" class="form-control" id="menu-type-1-2">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-1-2" class="form-control" value="" placeholder="链接地址或者按钮的key">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单3:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-1-3" maxlength="10" value="" class="form-control" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-1-3" onchange="changeType($(this).val(),'1-3');" class="form-control" id="menu-type-1-3">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-1-3" class="form-control" value="" placeholder="链接地址或者按钮的key">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单4:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-1-4" maxlength="10" value="" class="form-control" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-1-4" onchange="changeType($(this).val(),'1-4');" class="form-control" id="menu-type-1-4">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-1-4" class="form-control" value="" placeholder="链接地址或者按钮的key">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单5:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-1-5" maxlength="10" value="" class="form-control" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-1-5" onchange="changeType($(this).val(),'1-5');" class="form-control" id="menu-type-1-5">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-1-5" class="form-control" value="" placeholder="链接地址或者按钮的key">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">菜单2:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-2" maxlength="7" class="form-control" value="" placeholder="一级菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-2" class="form-control" id="menu-type-2" onchange="changeType($(this).val(),'2');">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-2" class="form-control" placeholder="链接地址或者按钮的key" value="">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div><!-- /.row -->
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单1:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-2-1" maxlength="10" class="form-control" value="共享流程与问题" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-2-1" onchange="changeType($(this).val(),'2-1');" class="form-control" id="menu-type--1">
                                <option value="view" selected="">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-2-1" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单2:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-2-2" maxlength="10" class="form-control" value="活动客服" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-2-2" onchange="changeType($(this).val(),'2-2');" class="form-control" id="menu-type--2">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id" selected="">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-2-2" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单3:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-2-3" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-2-3" onchange="changeType($(this).val(),'2-3');" class="form-control" id="menu-type--3">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-2-3" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单4:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-2-4" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-2-4" onchange="changeType($(this).val(),'2-4');" class="form-control" id="menu-type--4">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-2-4" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单5:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-2-5" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-2-5" onchange="changeType($(this).val(),'2-5');" class="form-control" id="menu-type--5">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-2-5" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">菜单3:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-3" maxlength="7" class="form-control" value="" placeholder="一级菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-3" class="form-control" id="menu-type-3" onchange="changeType($(this).val(),'3');">
                                <option value="view" selected="">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-3" class="form-control" placeholder="链接地址或者按钮的key" value="">
                        </div><!-- /.col-lg-6 -->
                    </div>
                </div><!-- /.row -->
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单1:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-3-1" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-3-1" onchange="changeType($(this).val(),'3-1');" class="form-control" id="menu-type-3-1">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-3-1" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单2:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-3-2" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-3-2" onchange="changeType($(this).val(),'3-2');" class="form-control" id="menu-type-3-2">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-3-2" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单3:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-3-3" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-3-3" onchange="changeType($(this).val(),'3-3');" class="form-control" id="menu-type-3-3">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-3-3" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单4:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-3-4" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-3-4" onchange="changeType($(this).val(),'3-4');" class="form-control" id="menu-type-3-4">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-3-4" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">子菜单5:</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" name="menu-name-3-5" maxlength="10" class="form-control" value="" placeholder="子菜单名字">
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-1">
                            <select name="menu-type-3-5" onchange="changeType($(this).val(),'3-5');" class="form-control" id="menu-type-3-5">
                                <option value="view">view</option>
                                <option value="click">click</option>
                                <option value="media_id">media</option>
                            </select>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-5">
                            <input type="text" name="menu-keyword-3-5" class="form-control" value="" placeholder="链接地址或者按钮的key">

                        </div><!-- /.col-lg-6 -->
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="button" onclick="sub();" id="submit-btn" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:75%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">请选择要回复的素材</h3>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <input type="hidden" id="key_index">
                        <div class="row" id="media_data">
                            <p>正在加载中...</p>

                        </div>

                        <button onclick="getBeforePage()">上一页</button>
                        <button onclick="getNextPage()">下一页</button>

                    </div>
                    <div class="modal-footer" id="button">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var page = 1;
            function getNextPage() {
                page = page + 1;
                html_str = '<p>正在加载中...</p>';
                $("#media_data").html(html_str);
                $.ajax({
                    url:'/v2/setting/appmenu?media',
                    type:'get',
                    data:{page:page},
                    dataType:"html",
                    success:function(data){
                        if(data == ''){
                            alert('没有更多数据了~');
                        }else{
                            $("#media_data").html(data);
                        }
                    }
                });
            }

            function getBeforePage() {
                page = page - 1;
                html_str = '<p>正在加载中...</p>';
                $("#media_data").html(html_str);
                $.ajax({
                    url:'/v2/setting/appmenu?media',
                    type:'get',
                    data:{page:page},
                    dataType:"html",
                    success:function(data){
                        if(data == ''){
                            alert('没有更多数据了~');
                        }else{
                            $("#media_data").html(data);
                        }
                    }
                });
            }

            function sub(){
                $.ajax({
                    url:'/v2/setting/appmenu',
                    type:'post',
                    data:$("#menu-form").serialize(),
                    dataType:"json",
                    success:function(data){
                        alert(data.msg);
                        if(data.result){
                            location.reload();
                        }
                    }
                });
            }

            function changeType(v_type,index){
                if(v_type == "media_id"){

                    $.ajax({
                        url:'/v2/setting/appmenu?media',
                        type:'get',
                        data:{page:page},
                        dataType:"html",
                        success:function(data){
                            $("#media_data").html(data);
                        }
                    });

                    $('#myModal').modal();
                    //alert(v_type+"-"+index);
                    $("#key_index").val(index);
                }

            }

            function setMedia(media_id){
                var index = $("#key_index").val();
                $(":text[name='menu-keyword-"+index+"']").val(media_id);

                $('#myModal').modal('hide');
            }

        </script>

    </div><!--end .app-inner-->
</div>
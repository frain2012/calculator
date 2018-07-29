<?php
use yii\helpers\Html;

$this->title = '切换-商家中心';
?>
<?=Html::jsFile('@web/js/laydate/laydate.js')?>
<?=Html::jsFile('@web/js/webuploader.min.js')?>
<?=Html::cssFile('@web/css/webuploader.css')?>
<?=Html::cssFile('@web/ueditor/themes/default/css/ueditor.css')?>
<?=Html::jsFile('@web/ueditor/ueditor.config.js')?>
<?=Html::jsFile('@web/ueditor/ueditor.all.min.js')?>

<div class="breadcrumb">
    <a href="/v2">合肥公众号</a>
    <span class="text-muted">/</span>
    <a href="/v2/plug">应用</a>
    <span class="text-muted">/</span>
    <a href="/v2/plug/ysfudai">集福袋(H5)</a>
    <span class="text-muted">/</span>
    <span class="text-muted">编辑</span>
</div>

<div class="app">
    <div class="app-inner">


        <div class="row">
            <div class="col-sm-offset-2 col-sm-8 hide" id="error-div">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">出错了:</span>
                    <span id="error-msg"></span>
                </div>
            </div>
        </div>

        <div class="app-design clearfix" id="appDesign" style="padding-bottom: 34px;">
            <form class="form-horizontal" id="fudai-form" style="">
                <div class="para-title">
                    <h3 class=""><span class="glyphicon glyphicon-picture"></span> 基础信息 <small>(必填)</small></h3>
                    <p class="para-title-side"><a data-toggle="collapse" href="#collapseBasic" aria-expanded="true" aria-controls="collapseBasic">
                            <span class="glyphicon glyphicon-minus"></span> 收起</a></p>
                </div>
                <div class="collapse in" id="collapseBasic" style="">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 活动标题</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" name="name" value="<?php if(!is_null($data)){echo $data->name;}?>" placeholder="">
                            <input type="hidden" id="id" name="id" value="<?php if(!is_null($data)){echo $data->id;}?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 头图</label>
                        <div class="col-sm-6">
                            <div class="uploader-demo">
                                <div id="uploadHeadImg">选择图片</div>
                            </div>
                            <small class="text-muted">上传640x320px图片</small>
                            <input type="hidden" id="logo-0-input" name="headimg" value="<?php if(!is_null($data)){echo $data->headimg;}?>">
                            <p>
                                <img width="100px" height="50px" id="logo-0-src" src="<?php if(!is_null($data)){echo $data->headimg;}?>">
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong class="text-danger">*</strong> 是否显示活动数据</label>

                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="showdata" <?php if(!is_null($data) && $data->showdata==1){echo "checked='checked'";}?> value="1" required=""> 显示</label>
                        </div>

                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="showdata" <?php if(!is_null($data) && $data->showdata==2){echo "checked='checked'";}?> value="2" required=""> 隐藏</label>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong class="text-danger">*</strong> 是否显示活动规则</label>

                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="showrule" <?php if(!is_null($data) && $data->showrule==1){echo "checked='checked'";}?> value="1" required=""> 显示</label>
                        </div>

                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="showrule"  <?php if(!is_null($data) && $data->showrule==2){echo "checked='checked'";}?>  value="2" required=""> 隐藏</label>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 活动时间</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">从</div>
                                <input type="text" class="form-control" value="<?php if(!is_null($data)){echo $data->start;}?>" id="start_time" name="start" placeholder="开始时间">
                                <div class="input-group-addon">到</div>
                                <input type="text" class="form-control" value="<?php if(!is_null($data)){echo $data->end;}?>" id="end_time" name="end" placeholder="结束时间">
                                <script>
                                    var startDate = laydate.render({
                                        elem: '#start_time'
                                        ,type: 'datetime'
                                        ,format: 'yyyy-MM-dd HH:mm:ss'
                                        ,done: function (value, date) {
                                            if (value !== '') {
                                                endDate.config.min.year = date.year;
                                                endDate.config.min.month = date.month - 1;
                                                endDate.config.min.date = date.date;
                                            } else {
                                                endDate.config.min.year = '';
                                                endDate.config.min.month = '';
                                                endDate.config.min.date = '';
                                            }
                                        }
                                    });
                                    var endDate = laydate.render({
                                        elem: '#end_time'
                                        ,type: 'datetime'
                                        ,format: 'yyyy-MM-dd HH:mm:ss'
                                        , done: function (value, date) {
                                            if (value !== '') {
                                                startDate.config.max.year = date.year;
                                                startDate.config.max.month = date.month - 1;
                                                startDate.config.max.date = date.date;
                                            } else {
                                                startDate.config.max.year = '';
                                                startDate.config.max.month = '';
                                                startDate.config.max.date = '';
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 活动介绍</label>
                        <div class="col-sm-8" style="">
                            <script id="editor" type="text/plain" style="width:1024px;height:500px;" name="content">
                                <?php if(!is_null($data)){echo $data->content;}?>
                            </script>
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong>是否开启地理位置限制</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="need_pos" value="0" checked="checked" required="">关闭
                            </label>
                            <label style="padding-right:15px">
                                <input type="radio" name="need_pos" value="1" required="">开启
                            </label>
                            <span style="color:red;">(开启之后,用户必须允许获取地理位置才能参与活动,需要把您的活动域名添加到微信公众号后台的js安全域名里才可以正常获取用户的地址位置)</span>
                        </div>
                    </div>-->

                </div>

                <div class="para-title">
                    <h3 class=""><span class="glyphicon glyphicon-gift"></span> 奖品设置 <small>(<strong class="text-danger">*</strong> 必填)</small></h3>
                    <p class="para-title-side">
                        <a data-toggle="collapse" href="#collapsePrize" aria-expanded="true" aria-controls="collapsePrize"><span class="glyphicon glyphicon-minus"></span> 收起</a>
                    </p>
                </div>
                <div class="collapse in" id="collapsePrize">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 奖品名称</label>
                        <div class="col-sm-8">
                            <input type="text" name="awardname" class="form-control" value="<?php if(!is_null($data)){echo $data->awardname;}?>" id="prize_name" placeholder="奖品名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 奖品总数</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="prize_total" name="awardnum" value="<?php if(!is_null($data)){echo $data->awardnum;}?>" placeholder="奖品发放份数">
                                <div class="input-group-addon">份</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 奖品价格</label>
                        <div class="col-sm-4" style="display: none;">
                            <div class="input-group">
                                <div class="input-group-addon">底价</div>
                                <input type="text" class="form-control" id="min_price" name="min_price" value="" data-toggle="tooltip" data-placement="top" title="" placeholder="底价" data-original-title="底价">
                                <div class="input-group-addon">元</div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-addon">原价</div>
                                <input type="text" class="form-control" id="price" name="awardprize" placeholder="奖品原价" value="<?php if(!is_null($data)){echo $data->awardprize;}?>">
                                <div class="input-group-addon">元</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 奖品类型</label>
                        <div class="col-sm-4">
                            <label class="checkbox"><input type="radio" name="awardtype" value="1" <?php if(!is_null($data) && $data->awardtype==1){echo "required";}?> onchange="setSendType(1)"> 不需物流(凭兑奖码到店使用或兑换)</label>
                        </div>
                        <div class="col-sm-4">
                            <label class="checkbox"><input type="radio" name="awardtype" value="2" <?php if(!is_null($data) && $data->awardtype==2){echo "required";}?> onchange="setSendType(2)"> 物流邮寄(需填收货地址)</label>
                        </div>
                    </div>


                    <div id="store_form">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 兑奖码来源</label>
                            <div class="col-sm-2">
                                <label class="checkbox"><input type="radio" name="awardcode" <?php if(!is_null($data) && $data->awardcode==1){echo "required";}?> onchange="setPrizeCodeType(1)" value="1" required=""> 系统自动生成</label>
                            </div>
                            <div class="col-sm-6">
                                <label class="checkbox"><input type="radio" name="awardcode" <?php if(!is_null($data) && $data->awardcode==2){echo "required";}?> onchange="setPrizeCodeType(2)" value="2" required=""> 其它平台导入(<span class="text-danger">* 切记在活动列表的“奖品外部兑奖码”，导入外部核销码</span>)</label>
                            </div>
                        </div>



                        <div class="form-group" id="sel_store_form" style="display: none;">
                            <label class="col-sm-2 control-label"><strong class="text-danger">*</strong> 奖品适用门店</label>
                            <div class="col-sm-8">
                                <a href="javascript:" class="btn btn-success" data-toggle="modal" data-target="#select_store">选门店</a>
                                <span class="text-muted" id="sel_shop_txt">已选0个门店</span>
                                <input type="hidden" name="shop_list" id="shop_list" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 兑奖提示</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="awardtips"  id="prize_tip" placeholder="兑奖须知，如奖品使用说明、客服电话等">
                                    <?php if(!is_null($data)){echo $data->awardtips;}?>
                                </textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="para-title">
                    <h3 class=""><span class="glyphicon glyphicon-equalizer"></span> 福袋设置 <small>(必填)</small></h3>
                    <p class="para-title-side"><a data-toggle="collapse" href="#collapseBargin" aria-expanded="true" aria-controls="collapseBargin"><span class="glyphicon glyphicon-minus"></span> 收起</a></p>
                </div>
                <div class="collapse in" id="collapseBargin">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><strong class="text-danger">*</strong> 集齐几个福袋获奖</label>

                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="fudaitype" value="2" <?php if(!is_null($data) && $data->fudaitype==2){echo "checked";}?> onchange="setKeyType(2)"> 集齐八个福袋获奖</label>
                        </div>

                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="fudaitype" value="1" <?php if(!is_null($data) && $data->fudaitype==1){echo "checked";}?> onchange="setKeyType(1)"> 集齐四个福袋兑奖</label>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 福袋文字内容</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon"><small class="text-muted">第一个</small></div>
                                        <input type="text" class="form-control" id="" name="key1" value="<?php if(!is_null($data)){echo $data->key1;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon"><small class="text-muted">第二个</small></div>
                                        <input type="text" class="form-control" id="" name="key2" value="<?php if(!is_null($data)){echo $data->key2;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon"><small class="text-muted">第三个</small></div>
                                        <input type="text" class="form-control" id="" name="key3" value="<?php if(!is_null($data)){echo $data->key3;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon"><small class="text-muted">第四个</small></div>
                                        <input type="text" class="form-control" id="" name="key4" value="<?php if(!is_null($data)){echo $data->key4;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                    </div>
                                </div>

                                <div id="eight_txt_div" style="">
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <div class="input-group-addon"><small class="text-muted">第五个</small></div>
                                            <input type="text" class="form-control" id="" name="key5" value="<?php if(!is_null($data)){echo $data->key5;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <div class="input-group-addon"><small class="text-muted">第六个</small></div>
                                            <input type="text" class="form-control" id="" name="key6" value="<?php if(!is_null($data)){echo $data->key6;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <div class="input-group-addon"><small class="text-muted">第七个</small></div>
                                            <input type="text" class="form-control" id="" name="key7" value="<?php if(!is_null($data)){echo $data->key7;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <div class="input-group-addon"><small class="text-muted">第八个</small></div>
                                            <input type="text" class="form-control" id="" name="key8" value="<?php if(!is_null($data)){echo $data->key8;}?>" placeholder="限一个字" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 每天默认抽奖次数</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="" name="daynum" value="<?php if(!is_null($data)){echo $data->daynum;}?>" placeholder="" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                <div class="input-group-addon">次/天</div>
                            </div>
                        </div>
                        <div class="col-sm-4"><p class="form-control-static text-muted">用户每天默认可以抽奖的次数，次数未用完隔天不叠加</p></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="prizeforsale"><strong class="text-danger">*</strong> 分享可加次数</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">最多</div>
                                <input type="text" name="sharenum" value="<?php if(!is_null($data)){echo $data->sharenum;}?>" class="form-control" placeholder="">
                                <div class="input-group-addon">次/天</div>
                            </div>
                        </div>
                        <div class="col-sm-4"><p class="form-control-static text-muted">每天分享最多可加的次数，每个好友进活动加1次</p></div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">关注公众号加次数</label>

                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="focustype" <?php if(!is_null($data) && $data->focustype==2){echo "checked";}?>  value="2" required="" onchange="setMpType(2)"> 关闭</label>
                        </div>
                        <div class="col-sm-3">
                            <label class="checkbox"><input type="radio" name="focustype" <?php if(!is_null($data) && $data->focustype==1){echo "checked";}?>  value="1" required="" onchange="setMpType(1)"> 开启</label>
                        </div>

                        <div class="col-sm-3" id="mp_num_txt_1" style="display: none;">
                            <div class="input-group">
                                <div class="input-group-addon">每个公众号加</div>
                                <input type="text" class="form-control" name="focusnum" value="<?php if(!is_null($data)){echo $data->focusnum;}?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="用户关注指定公众号可以加的抽奖次数">
                                <div class="input-group-addon">次</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="mp_num_txt_2" style="display: none;">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 指定要关注的公众号（支持多个号）</label>
                        <div class="col-sm-8">
                            <div class="row">

                                <div class="col-sm-2">
                                    <label class="checkbox">
                                        <input type="checkbox" name="focusacct[]" value="881" required=""> 指尖合肥</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="para-title">
                    <h3 class=""><span class="glyphicon glyphicon-gift"></span> 发奖设置 </h3>
                    <p class="para-title-side"><a data-toggle="collapse" href="#collapseRule" aria-expanded="true" aria-controls="collapseRule"><span class="glyphicon glyphicon-minus"></span> 收起</a></p>
                </div>
                <div class="collapse in" id="collapseRule">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"><strong class="text-danger">*</strong> 几次抽奖可出一份奖品</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">满</div>
                                <input type="text" class="form-control" name="sendnum" value="<?php if(!is_null($data)){echo $data->sendnum;}?>" placeholder="累计次数">
                                <div class="input-group-addon">次/一份奖品</div>
                            </div>
                        </div>
                        <div class="col-sm-4"><p class="form-control-static text-muted">按本活动总抽奖次数统计，平均每抽满几次时发出一份奖品</p></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">预计最低参与人数</label>
                        <div class="col-sm-8">
                            <p class="form-control-static text-danger">暂无（数据仅供参考,具体数据以活动实际结果为准）</p>
                            <div class="form-control-static text-muted">
                                <p>预计最低参与人数 = ( 出一份奖品需要的次数 * 奖品份数 ) ÷ 人均最大可用次数</p>
                                <p>人均最大可用次数 = 每天默认次数 + 分享群加的次数 + 分享海报加的次数 + 关注公众号加的次数 * 公众号个数</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="para-title">
                    <h3 class=""><span class="glyphicon glyphicon-equalizer"></span> 微信分享信息</h3>
                    <p class="para-title-side"><a data-toggle="collapse" href="#collapseShare" aria-expanded="true" aria-controls="collapseShare"><span class="glyphicon glyphicon-minus"></span> 收起</a></p>
                </div>

                <div class="collapse in" id="collapseShare">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">标题</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="share_title" name="sharetitle" value="<?php if(!is_null($data)){echo $data->sharetitle;}?>" placeholder="20个字以内">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">分享内容</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="share_content" name="sharedesc" value="<?php if(!is_null($data)){echo $data->sharedesc;}?>" placeholder="40个字以内">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">分享小图</label>
                        <div class="col-sm-6">
                            <div class="uploader-demo">
                                <div id="uploadHeadImg1">选择图片</div>
                            </div>
                            <small class="text-muted">请上传200x200px的图片</small>
                            <input type="hidden" id="share_logo-0-input" name="shareimg" value="<?php if(!is_null($data)){echo $data->shareimg;}?>">
                            <p>
                                <img width="80px" height="80px" id="share_logo-0-src" src="<?php if(!is_null($data)){echo $data->shareimg;}else{ echo '/images/photo_default.png';}?>"">
                            </p>
                        </div>
                    </div>
                </div>
            </form>

            <div class="app-design-action text-center">
                <button type="button" class="btn btn-primary" id="submit-btn" onclick="save();">保存</button>
            </div>
        </div>
        <script>
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
                        $( '#logo-0-input').val(response.url);
                        $( '#logo-0-src').attr({'src':response.url});
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
                    url: '/plug/ysfudaiedit',
                    type: 'post',
                    dataType: 'json',
                    data: $('#fudai-form').serialize(),
                    success: function(data) {
                        alert(data.msg);
                        if (data.status==0)
                        {
                            window.location.href = '/plug/ysfudai';
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

            $('input[name="need_pos"]').click(function(){
                var need_pos = $(this).val();
                if(need_pos == 1){
                    $("#area_div").show();
                    //loadProvince();
                }else{
                    $("#area_div").hide();
                }
            });
            $('input[name="open_remark"]').click(function(){
                var open_remark = $(this).val();
                if(open_remark == 1){
                    $("#open_remark_div").show();
                    //loadProvince();
                }else{
                    $("#open_remark_div").hide();
                }
            });

            setSendType('2');
            setPrizeCodeType('1');

            setMpType('1');
            setKeyType('2');

            function setSendType(s_type){
                if(s_type == 2){
                    $("#store_form").hide();
                }else{
                    $("#store_form").show();
                }
            }

            function setKeyType(s_type){
                if(s_type == 2){
                    $("#eight_txt_div").show();
                }else{
                    $("#eight_txt_div").hide();
                }
            }
            function setMpType(s_type){
                if(s_type == 2){
                    $("#mp_num_txt_1").hide();
                    $("#mp_num_txt_2").hide();
                }else{
                    $("#mp_num_txt_1").show();
                    $("#mp_num_txt_2").show();
                }
            }

            function setPrizeCodeType(s_type){
                if(s_type == 1){
                    $("#sel_store_form").show();
                }else{
                    $("#sel_store_form").hide();
                }
            }

        </script>




    </div><!--end .app-inner-->
</div>

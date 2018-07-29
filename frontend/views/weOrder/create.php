<?php
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '创建商品';
?>
<div class="container-fluid">
<div class="well">
<ol class="breadcrumb">
	<li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
	<li class="active">创建商品</li>
</ol>

<!-- <ul class="nav nav-tabs nav-width">
	<li class="normal"><a href="javascript:;">1.</a></li>
	<li class="active"><a href="javascript:;">2. 设置公众号信息</a></li>
	<li class="normal"><a href="javascript:;">3. 设置权限</a></li>
	<li class="normal"><a href="javascript:;">4. 引导页面</a></li>
</ul> -->

<div class="clearfix">
		<form action="" method="post" class="form-horizontal form-validate" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				基本设置
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 活动名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="title" class="form-control" datatype="*2-16" errormsg="名称范围在2~16位之间！">
						<span class="help-block">填写活动名称</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>触发关键词</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="key" class="form-control" datatype="*2-16" errormsg="关键词范围在2~16位之间！">
						<span class="help-block">从填写关键词里选</span>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>活动日期</label>
	                <div class="col-sm-9 col-xs-12">
	                	<div class="input-group">
		                	<input type="text" name="start" placeholder="请选择开始日期" readonly="readonly" class="datetimepicker form-control" style="padding-left:12px;">
		                	<span class="input-group-addon">至</span>
							<input type="text" name="end" placeholder="请选择结束日期" readonly="readonly" class="datetimepicker form-control" style="padding-left:12px;">
						</div>
	                </div>
	            </div>
	            <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>是否开启IP</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="isip">
							<option value="0">否</option>
							<option value="1">是</option>
						</select>
					</div>
				</div>
	            <script type="text/javascript">
	            $(function($) {
	            	$('.datetimepicker').datetimepicker({format:"Y-m-d h:s",timepicker:true,step:5});
	            });
	            </script>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>区域名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="ip" class="form-control"/>
						<span class="help-block">注意：(区域名称+开启IP区域限制)例如:安徽.如果有多个安徽,合肥</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">参与次数</label>
					<div class="col-sm-9 col-xs-12">
						<div class="row">
							<div class="col-xs-6">
								<select class="form-control" name="unit">
									<option value="1">总共</option>
									<option value="2">每天</option>
								</select>
							</div>
							<div class="col-xs-6">
								<div class="input-group">
									<input type="text" name="num" class="form-control"/>
									<span class="input-group-addon">次</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 奖项1</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="first" class="form-control" datatype="n" errormsg="奖项为数字！">
						<span class="help-block">从兑奖商品里选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 奖项2</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="two" class="form-control" datatype="n" errormsg="奖项为数字！">
						<span class="help-block">从兑奖商品里选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 奖项3</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="three" class="form-control" datatype="n" errormsg="奖项为数字！">
						<span class="help-block">从兑奖商品里选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 奖项4</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="four" class="form-control" datatype="n" errormsg="奖项为数字！">
						<span class="help-block">从兑奖商品里选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 奖项5</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="five" class="form-control" datatype="n" errormsg="奖项为数字！">
						<span class="help-block">从兑奖商品里选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 奖项6</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="six" class="form-control" datatype="n" errormsg="奖项为数字！">
						<span class="help-block">从兑奖商品里选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 奖项7</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="seven" class="form-control" datatype="n" errormsg="奖项为数字！">
						<span class="help-block">从兑奖商品里选</span>
					</div>
				</div>
				
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input name="submit" type="submit" value="保存" class="btn btn-primary">
			</div>
		</div>
	</form>
	</div>
			</div>
		</div>
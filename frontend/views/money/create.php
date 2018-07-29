<?php
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '创建现金红包';
?>
<div class="container-fluid">
<div class="well">
<ol class="breadcrumb">
	<li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
	<li><a href="/money/list?wid=<?=$wid?>">现金红包</a></li>
	<li class="active">创建现金红包</li>
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
						<input type="text" name="name" class="form-control" datatype="*2-16" errormsg="名称范围在2~16位之间！">
						<span class="help-block">填写活动名称</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>关键词</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="key" class="form-control" datatype="*2-16" errormsg="关键词范围在2~16位之间！">
						<span class="help-block">填写关键词</span>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>活动日期</label>
	                <div class="col-sm-9 col-xs-12">
	                	<div class="input-group">
		                	<input type="text" name="sdate" placeholder="请选择开始日期" readonly="readonly" class="datetimepicker form-control" style="padding-left:12px;">
		                	<span class="input-group-addon">至</span>
							<input type="text" name="edate" placeholder="请选择结束日期" readonly="readonly" class="datetimepicker form-control" style="padding-left:12px;">
						</div>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>活动时间</label>
	                <div class="col-sm-9 col-xs-12">
	                	<div class="input-group">
		                	<input type="text" name="stime" placeholder="请选择开始时间" readonly="readonly" class="timePicker form-control" style="padding-left:12px;">
		                	<span class="input-group-addon">至</span>
							<input type="text" name="etime" placeholder="请选择结束时间" readonly="readonly" class="timePicker form-control" style="padding-left:12px;">
						</div>
	                </div>
	            </div>
	            <script type="text/javascript">
	            $(function($) {
	            	$('.datetimepicker').datetimepicker({format:"Y-m-d",timepicker:false});
	            	$('.timePicker').datetimepicker({format:'H:i',datepicker:false,step:5});
	            });
	            </script>
	            <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>红包发放金额</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="total" class="form-control"/>
						<span class="help-block">注意：发放总金额</span>
					</div>
				</div>
	            <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>开启IP区域限制</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="isarea">
							<option value="0">否</option>
							<option value="1">是</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>区域名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="area" class="form-control"/>
						<span class="help-block">注意：(区域名称+开启IP区域限制)例如:安徽.如果有多个安徽,合肥</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">参与次数</label>
					<div class="col-sm-9 col-xs-12">
						<div class="row">
							<div class="col-xs-6">
								<select class="form-control" name="type">
									<option value="0">总共</option>
									<option value="1">每天</option>
									<option value="2">每时</option>
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
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">红包金额</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
		                	<input type="text" name="smoney" placeholder="最小金额" class="form-control" style="padding-left:12px;">
		                	<span class="input-group-addon">至</span>
							<input type="text" name="mmoney" placeholder="最大金额" class="form-control" style="padding-left:12px;">
						</div>
						<span class="help-block">注意：(最小金额>=1元,最大金额<=200元).</span>
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
<?php
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '图文素材创建';
?>
<div class="container-fluid">
<div class="well">
<ol class="breadcrumb">
	<li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
	<li class="active">创建图文素材</li>
</ol>

<!-- <ul class="nav nav-tabs nav-width">
	<li class="normal"><a href="javascript:;">1.</a></li>
	<li class="active"><a href="javascript:;">2. 设置公众号信息</a></li>
	<li class="normal"><a href="javascript:;">3. 设置权限</a></li>
	<li class="normal"><a href="javascript:;">4. 引导页面</a></li>
</ul> -->

<div class="clearfix">
		<form action="" method="post" class="form-horizontal form-validate" enctype = 'multipart/form-data'  id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				基本设置
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 标题</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="BaseMaterial[title]" class="form-control" datatype="*2-16" errormsg="名称范围在2~16位之间！">
						<span class="help-block">填写标题名称</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>图文封面</label>
					<div class="col-sm-9 col-xs-12">
						<input type="file" name="BaseMaterial[image]" class="form-control" datatype="*" errormsg="关键词范围在2~16位之间！">
						<span class="help-block">选择图文封面</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">简介</label>
					<div class="col-sm-9 col-xs-12">
						<textarea rows="" cols="" class="form-control" name="BaseMaterial[description]"></textarea>
						<span class="help-block">填写简介</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>图文外链类型</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="BaseMaterial[type]" datatype="n" id="type">
							<option value="1">图文</option>
							<option value="2">外链</option>
							<option value="3">红包活动</option>
							<option value="4">预约活动</option>
						</select>
					</div>
				</div>
				<div class="form-group" id="ndetail">
	                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>图文详情页内容</label>
	                <div class="col-sm-9 col-xs-12">
	                	<textarea rows="" cols="" class="form-control" name="BaseMaterial[content]"></textarea>
						<span class="help-block">图文详情页内容</span>
	                </div>
	            </div>
				<div class="form-group" id="wlink" style="display:none;">
	                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>外链</label>
	                <div class="col-sm-9 col-xs-12">
		                <input type="text" name="BaseMaterial[link]" class="form-control" />
	                </div>
	            </div>
	            <script type="text/javascript">
	            $(function($) {
		            $('#type').change(function(){
			            var type = $(this).val();
			            switch(type){
			            	case "1":
				            	$('#ndetail').show();
				            	$('#wlink').hide();
				            	break;
			            	case "2":
			            		$('#ndetail').hide();
				            	$('#wlink').show();
				            	break;
			            	case "3":
			            	case "4":
			            		$('#ndetail').hide();
				            	$('#wlink').hide();
				            	break;
				            default:
					            return ;
					    }
				    });
	            });
	            </script>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="hidden" name="BaseMaterial[ispost]" value="1">
				<input name="submit" type="submit" value="保存" class="btn btn-primary">
			</div>
		</div>
	</form>
	</div>
			</div>
		</div>
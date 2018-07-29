<?php
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '关注回复';
?>
<div class="container-fluid">
<div class="well">
<ol class="breadcrumb">
	<li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
	<li class="active">关注回复</li>
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
				关注回复设置
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>回复类型</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="type" id="type">
							<option value="0" <?php if(!empty($model) && ($model->type==0)) echo 'selected="selected"'?>>文本</option>
							<option value="1" <?php if(!empty($model) && ($model->type==1)) echo 'selected="selected"'?>>图文</option>
						</select>
						<span class="help-block">请选择回复类型</span>
					</div>
				</div>
				<script type="text/javascript">
	            $(function($) {
		            $('#type').change(function(e){
		            	var type = $(this).val();
		            	if(type==0){
			            	$("#textreply").show();
			            	$("#newsreply").hide();
			            }else{
			            	$("#textreply").hide();
			            	$("#newsreply").show();
					    }
			        });
	            });
	            </script>
				<div class="form-group" id="textreply">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>文本内容</label>
					<div class="col-sm-9 col-xs-12">
						<textarea rows="" cols="" class="form-control" name="content"><?php if(!empty($model)) echo $model->content;?></textarea>
						<span class="help-block">填写文本内容</span>
					</div>
				</div>
				<div class="form-group" id="newsreply" style="display:none;">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>选择素材</label>
					<div class="col-sm-9 col-xs-12">
						<button class="form-control" onclick="javascript:void(0);">选择素材</button>
						<span class="help-block">请选择素材</span>
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
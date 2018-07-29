<?php
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '编辑商品';
?>
<div class="container-fluid">
<div class="well">
<ol class="breadcrumb">
	<li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
	<li class="active">商品编辑</li>
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
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 商品名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="name" class="form-control" datatype="*2-16" errormsg="名称范围在2~16位之间！" value="<?=$model->name;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>是否IP奖品</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="isip">
							<option value="0" <?php if ($model->isip == 0) echo 'selected="selected"';?>>否</option>
							<option value="1" <?php if ($model->isip == 1) echo 'selected="selected"';?>>是</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>是否红包</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="ismoney" id="smoney">
							<option value="0" <?php if ($model->ismoney == 0) echo 'selected="selected"';?>>否</option>
							<option value="1" <?php if ($model->ismoney == 1) echo 'selected="selected"';?>>是</option>
						</select>
						<!-- <span class="help-block">填写关键词</span> -->
					</div>
				</div>
				<div class="form-group" id="money" <?php if ($model->ismoney != 1) echo 'style="display:none;"';?>>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>红包金额</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="money" class="form-control" value="<?=$model->money;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>中奖率</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="rate" class="form-control" value="<?=$model->rate;?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>奖品总数量</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="tnum" class="form-control" value="<?=$model->tnum;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>可兑奖数量</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="anum" class="form-control" value="<?=$model->anum;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>是否开启支付</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="ispay" id="spay">
							<option value="0" <?php if ($model->ispay == 0) echo 'selected="selected"';?>>否</option>
							<option value="1" <?php if ($model->ispay == 1) echo 'selected="selected"';?>>是</option>
						</select>
						<!-- <span class="help-block">填写关键词</span> -->
					</div>
				</div>
				<div class="form-group" id="pay" <?php if ($model->ispay != 1) echo 'style="display:none;"';?>>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>支付金额</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="pay" class="form-control" value="<?=$model->pay;?>">
					</div>
				</div>
				<script type="text/javascript">
	            $(function($) {
	            	$('#smoney').change(function(){
			            var val = $(this).val();
			            switch(val){
				            case "0":
					            $('#money').hide();
					            break;
				            case "1":
				            	$('#money').show();
					            break;
					        default:
						        break;
			            }
			        });
		            $('#spay').change(function(){
			            var val = $(this).val();
			            switch(val){
				            case "0":
					            $('#pay').hide();
					            break;
				            case "1":
				            	$('#pay').show();
					            break;
					        default:
						        break;
			            }
			        });
	            });
	            </script>
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
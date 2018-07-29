<?php
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '微信支付设置';
?>
<div class="container-fluid">
<div class="well">
<div class="clearfix">
		<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-heading">
				微信支付设置
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>是否启用</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" name="WxPay[type]">
							<option value="0" <?php if ($model->type == 0) echo 'selected="selected"';?>>自身</option>
							<option value="1" <?php if ($model->type == 1) echo 'selected="selected"';?>>借用</option>
						</select>
						<span class="help-block" style="color:red">如果启用自身的，则不需要填写appid和appsecret</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">appid:</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="WxPay[appid]" value="<?=$model->appid?>" class="form-control">
						<span class="help-block" style="color:red">如果选择自身,可以不填写,如果选择借用则必须填写</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">appsecret:</label>
					<div class="col-sm-9 col-xs-12">
						<input type="password" name="appsecret" value="<?=$model->appsecret?>" class="form-control">
						<span class="help-block" style="color:red">如果选择自己,可以不填写,如果选择借用则必须填写</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>微信支付商户ID</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="mchid" value="<?=$model->mchid?>" class="form-control" datatype="s10-16" errormsg="微信支付商户至少10位整数">
						<span class="help-block">微信支付商</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>微信支付密钥</label>
					<div class="col-sm-9 col-xs-12">
						<input type="password" name="key" value="<?=$model->key?>" class="form-control" datatype="s32-32" errormsg="微信支付密钥为32位">
						<span class="help-block">微信支付商</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>CA证书</label>
					<div class="col-sm-9 col-xs-12">
						<input type="file" name="rootca" class="form-control">
						<span class="help-block"><?php if(!empty($model->rootca)) echo '<span style="color:red">已上传CA证书</span>';?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>cert证书</label>
					<div class="col-sm-9 col-xs-12">
						<input type="file" name="apiclientcert" class="form-control">
						<span class="help-block"><?php if(!empty($model->rootca)) echo '<span style="color:red">已上传cert证书</span>';?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>证书密钥</label>
					<div class="col-sm-9 col-xs-12">
						<input type="file" name="apiclientkey" class="form-control">
						<span class="help-block"><?php if(!empty($model->rootca)) echo '<span style="color:red">已上传证书密钥</span>';?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input type="submit" value="保存" class="btn btn-primary">
			</div>
		</div>
	</form>
	</div>
 </div>
</div>
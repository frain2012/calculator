<?php
use yii\helpers\Html;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '帐号信息';
?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="box">
			<div class="box-title">
				<h3>
					<span class="glyphicon glyphicon-edit" aria-hidden="true"></span><?=$this->title?>
				</h3>
			</div>
			
			<div class="box-content">
				<form action="" method="post" class="form-horizontal form-validate">
					<div class="control-group">
						<label for="name" class="control-label"><span class="maroon">*</span>商户名称：</label>
						<div class="controls">
							<input type="text" name="userForm[nickname]" datatype="s2-16" errormsg="商户名称至少2个字符,最多16个字符！" value="<?=$model->nickname?>"/>
						</div>
					</div>
					<div class="control-group">
						<label for="mobile" class="control-label"><span class="maroon">*</span>手机号码：</label>
						<div class="controls">
							<input type="text" name="userForm[telephone]" datatype="m" errormsg="手机号码格式不正确！" value="<?=$model->telephone?>"/>
						</div>
					</div>
					<div class="control-group">
						<label for="qq" class="control-label"><span class="maroon">*</span>常用QQ号码：</label>
						<div class="controls">
							<input type="text" name="userForm[qq]" datatype="n5-12" errormsg="QQ号码不正确！" value="<?=$model->qq?>"/>
						</div>
					</div>
					<div class="control-group">
						<label for="email" class="control-label"><span class="maroon">*</span>常用email：</label>
						<div class="controls">
							<input type="text" name="userForm[email]" datatype="e" errormsg="email格式不正确！" value="<?=$model->email?>"/>
						</div>
					</div>
					<div class="control-group">
						<label for="email" class="control-label">套餐类型：</label>
						<div class="controls">
							<b class="text-warning">演示版</b>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">保存</button>
						<a class="btn" href="Javascript:window.history.go(-1)">取消</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
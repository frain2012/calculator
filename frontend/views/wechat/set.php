<?php
use yii\helpers\Html;
use yii\helpers\Url;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '帐号配置';
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
						<label for="name" class="control-label"><span class="maroon">*</span>帐号类型：</label>
						<div class="controls">
							<input type="radio" name="Wechat[type]" value="1" <?php if ($model->type == 1) echo 'checked="checked"'?> />未认证订阅号
							<input type="radio" name="Wechat[type]" value="2" <?php if ($model->type == 2) echo 'checked="checked"'?> />认证订阅号
							<input type="radio" name="Wechat[type]" value="3" <?php if ($model->type == 3) echo 'checked="checked"'?> />未认证服务号
							<input type="radio" name="Wechat[type]" value="4" <?php if ($model->type == 4) echo 'checked="checked"'?> />认证服务号
						</div>
					</div>
					<div class="control-group">
						<label for="mobile" class="control-label"><span class="maroon">*</span>APPID：</label>
						<div class="controls">
							<input type="text" name="Wechat[appid]" datatype="s18-18" errormsg="appid范围为18位！" value="<?=$model->appid?>"/>
						</div>
					</div>
					<div class="control-group">
						<label for="mobile" class="control-label"><span class="maroon">*</span>APPSECRT：</label>
						<div class="controls">
							<input type="password" name="Wechat[appsecrt]" datatype="s32-32" errormsg="appsecrt为32位" value="<?=$model->appsecrt?>"/>
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
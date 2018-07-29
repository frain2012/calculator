<?php
use yii\helpers\Html;
use yii\helpers\Url;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '修改密码';
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
					<?php if (Yii::$app->session->hasFlash('alerts')) {?>
						<div class="alert alert-danger" role="alert"><?php echo Yii::$app->session->getFlash('alerts')?></div>
					<?php }?>
					<div class="control-group">
						<label for="name" class="control-label"><span class="maroon">*</span>旧密码：</label>
						<div class="controls">
							<input type="password" name="userForm[oldpasswd]" datatype="s5-16" errormsg="旧密码范围在5~16位之间！"/>
						</div>
					</div>
					<div class="control-group">
						<label for="mobile" class="control-label"><span class="maroon">*</span>新密码：</label>
						<div class="controls">
							<input type="password" name="userForm[newpasswd]" datatype="s6-16" errormsg="密码范围在6~16位之间！"/>
						</div>
					</div>
					<div class="control-group">
						<label for="mobile" class="control-label"><span class="maroon">*</span>确认密码：</label>
						<div class="controls">
							<input type="password" name="userForm[repasswd]" datatype="*" recheck="userForm[newpasswd]" errormsg="您两次输入的账号密码不一致！"/>
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
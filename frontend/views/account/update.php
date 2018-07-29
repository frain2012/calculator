<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widget\FormWidget;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '编辑微信绑定';
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
				<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>公众帐号名称：</label>
						<div class="controls">
							<input type="text" name="Wechat[name]" datatype="*2-16" value="<?=$model->name?>" errormsg="名称范围在2~16位之间！"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>头像:</label>
						<div class="controls" style="display:inline-block;">
							<div class="image">
								<img src="<?= $model->head?>" style="width:60px;height:60px;"/>
								<input type="file" id="headimg" name="Wechat[head]" value="图片上传" accept="image/jpeg,image/gif,image/png" capture="camera">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>公众号原始：</label>
						<div class="controls">
							<?= $model->mpid?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>appid：</label>
						<div class="controls">
							<input type="text" name="Wechat[appid]" datatype="s18-18" errormsg="appid为18位的字符！" value="<?= $model->appid?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>appsecrt：</label>
						<div class="controls">
							<input type="text" name="Wechat[appsecrt]" datatype="s32-32" errormsg="appsecrt为32位的字符！" value="<?= $model->appsecrt?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>url：</label>
						<div class="controls">
							<?= YII::$app->params['website']['api']?>/api?t=<?=$model->mpurl?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>Token：</label>
						<div class="controls">
							<?=$model->mptoken?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>公众号类型：</label>
						<div class="controls">
							<input type="radio" name="Wechat[type]" datatype="*" errormsg="请选择帐号类型"  value="1" <?php if ($model->type == 1) echo 'checked="checked"';?>/>订阅号
							&nbsp;&nbsp;
							<input type="radio" name="Wechat[type]" value="2" <?php if ($model->type == 2) echo 'checked="checked"';?>/>认证订阅号
							&nbsp;&nbsp;
							<input type="radio" name="Wechat[type]" value="3" <?php if ($model->type == 3) echo 'checked="checked"';?>/>服务号
							&nbsp;&nbsp;
							<input type="radio" name="Wechat[type]" value="4" <?php if ($model->type == 4) echo 'checked="checked"';?>/>认证服务号
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
<?=Html::jsFile('@web/js/jquery-1.11.3.min.js')?>
<?=Html::jsFile('@web/js/bootstrap.min.js')?>
<?=Html::jsFile('@web/js/Validform.min.js')?>
<?=Html::jsFile('@web/js/form.js')?>
<script type="text/javascript">

/*$(function($) {
	$("#headimg").change(function(){
		 formdata = new FormData();
		 formdata.append('token', token);
		 formdata.append('file', $('#headimg')[0].files[0]);
		    $.ajax({
		        url: '//upload.qiniu.com',
		        type: 'POST',
		        contentType:false,
		        processData: false,
		        dataType: 'json',
		        data: formdata,
		        success:function(data){
		            if(!(typeof data.error === 'undefined')){
		                alert(data.error);
		                return;
		            }
		            $('#head').val((qnurl+data.key));
		            $('#img').html('<img src="'+(qnurl+data.key)+'?imageView2/0/w/50" />');
		        },
		        error:function(XMLResponse){alert(XMLResponse.responseText)},
		    });
	});
});*/
</script>

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
$this->title = '微信绑定编辑';
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
						<label class="control-label"><span class="maroon">*</span>公众帐号名称：</label>
						<div class="controls">
							<input type="text" name="Wechat[name]" datatype="*2-16" errormsg="名称范围在2~16位之间！" value="<?=$model->name?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>公众号原始id：</label>
						<div class="controls">
							<label><?=$model->sourceid?></label>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>微信号：</label>
						<div class="controls">
							<input type="text" name="Wechat[wechat]" datatype="*"  value="<?=$model->wechat?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>头像地址（url）:</label>
						<div class="controls">
							<label id="img"><img src="<?=$model->head?>?imageView2/0/w/50"></label>
							<input type="file" id="headimg"/>
							<input type="hidden" name="Wechat[head]" id="head" datatype="*" value="<?=$model->head?>"/>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>公众号邮箱：</label>
						<div class="controls">
							<input type="text" name="Wechat[wemail]" datatype="e" errormsg="邮箱格式不正确！" value="<?=$model->wemail?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>微信URL：</label>
						<div class="controls">
							<label><?=$model->wurl?></label>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><span class="maroon">*</span>微信TOKEN：</label>
						<div class="controls">
							<label><?=$model->wtoken?></label>
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
var qnurl = '<?=$url?>'+'/';
var token = '<?=$token?>';
$(function($) {
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
});
</script>

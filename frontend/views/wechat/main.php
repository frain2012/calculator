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
$this->title = '帐号信息';
?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="box">
			<div class="box-title">
				<h3>
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span><?=$this->title?>
				</h3>
			</div>
			<div class="box-content">
					<div class="row">
					  <div class="col-md-6">
					  	<dl class="dl-horizontal">
                            <dt>
                                <img src="<?=$model->head?>?imageView2/1/w/88/h/88" style="border-radius:50%;"></dt>
                            <dd>
                                <p style="font-size:16px;margin-top:10px;">
                                	<strong><?=$model->name?></strong>&nbsp;&nbsp;&nbsp;<!-- b>演示版</b> &nbsp;&nbsp;
                                	<a href="javascript:void(0);" data-toggle="modal" style="color:#fb7e62"><i class="icon-circle-arrow-up" title="升级"></i>升级</a -->
                                </p>
                                <p style="font-size:16px;margin-top:25px;">
                                	<a href="javascript:;">
                                	<?php switch ($model->type){
                                	    case 1:
                                	        echo '订阅号';
                                	        break;
                                	    case 2:
                                	        echo '认证订阅号';
                                	        break;
                                	    case 3:
                                	        echo '服务号';
                                	        break;
                                	    case 4:
                                	        echo '认证服务号';
                                	        break;
                                	    default:
                                	        echo '未知';
                                	        break;
                                	}?>
                                	</a><a class="btn btn-primary btn-large" style="margin-right:20px;" href="javascript:;">重新绑定</a>
                                </p>
                            </dd>
                        </dl>
					  </div>
					  
					  <div class="col-md-4">
					  	<div class="hero-unit" style="padding:20px;30px;margin-bottom: 0px">
                            <p>剩余<span style="color:#ff6440;font-size:22px;">无限</span>天</p>
                            <p style="font-size:14px;color:#7b8a97">无限</p>
                            <div class="progress">
							  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:0%">
							  </div>
							</div>
                        </div>
					  </div>
					</div>
                </div>
                
                <div class="box-content">
                    <table class="table noborder">
                    	<tbody>
                    	<tr>
                            <td>有效期:无限</td>
                            <td>文本自定义:无限</td>
                            <td>图文自定义:无限</td>
                        </tr>
                        <tr>
                            <td>请求数剩余:不限 </td>
                            <td>总请求数:8938</td>
                            <td>本月请求数:330</td>
                        </tr>
                    </tbody>
                    </table>
                    <p>
                    	<strong>接口地址：</strong><?= YII::$app->params['website']['api']?>/api?t=<?=$model->mpurl?> &nbsp;&nbsp;&nbsp;&nbsp;
                    	<strong>TOKEN：</strong><?=$model->mptoken?> &nbsp;&nbsp;&nbsp;&nbsp;
                    	<strong>个性域名：</strong><?=$model->domain?>
                    </p>
                </div>
			
		</div>
	</div>
</div>
<?=Html::jsFile('@web/js/jquery.js')?>
<?=Html::jsFile('@web/js/bootstrap.js')?>
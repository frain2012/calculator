<?php
use yii\helpers\Html;
use yii\helpers\Url;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '微信公众帐号管理';
?>
<div class="container-fluid">
		<div class="row-fluid">
			<div class="box">
				<div class="box-title">
					<h3>
						<span class="glyphicon glyphicon-th" aria-hidden="true"></span><?=$this->title?>
					</h3>
				</div>
                <div class="alert alert-warning" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                   	温馨提示:你只能添加一个帐号,暂时不支持删除。
                </div>
                
                 <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="control-group" style="color:#929292;margin-top:10px;">
                           <img src="/images/wei_small.jpg" style="width:100px;" alt="微信">
                           <a class="btn btn-info btn-large" style="margin-right:20px;" href="<?=Url::to(['account/create'])?>">手动绑定</a>填写公众号的相关信息及id，并且填写接口地址、TOKEN，个性域名等信息完成绑定后使用
                    	</div>
                </div>
                
                
				<div class="box-content">
					<div class="panel panel-default">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>公众号名称</th>
									<th>公众号类型</th>
									<th>创建时间</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($model as $item){?>
                            <tr>
                            	<td style="text-align:center;">
                                    <p>
                                        <a href="javascript:void(0)" onclick="parent.location.href='/wechat/index/aid/<?=$item->id?>'" title="点击进入功能管理">
                                        	<img src="<?=$item->head?>" style="width:88px;height:88px;">
                                        </a>
                                    </p>
                                    <p><?=$item->name?></p>
                                </td>
                                <td style="vertical-align:middle;">
                                	<p><?php switch ($item->type){
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
                                	}?></p>
                                </td>
                                <td style="vertical-align:middle;">
                                	<p>创建时间:<?=date('Y-m-d H:i:s', $item->created_at)?></p>
                                </td>
                                <td style="vertical-align:middle;">
										<a class="btn btn-default" href="/account/update/aid/<?=$item->id?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										<a class="btn btn-default" href="javascript:void(0)" onclick="parent.location.href='/wechat/index/aid/<?=$item->id?>'">
											<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
										</a>
                                    </td>
                            </tr>
                            <?php }?>
                           </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '活动列表';
?>
<div class="container-fluid">
		<div class="row-fluid">
			<div class="box">
				<div class="box-title">
					<h3>
						<span class="glyphicon glyphicon-th" aria-hidden="true"></span><?=$this->title?>
					</h3>
				</div>
                <!--div class="alert alert-warning" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">温馨提示:现金红包</span>
                  	<p>第一步:填写第三方的相关信息及名称，并且填写接口URL地址、TOKEN等</p>
                   	<p>第二步:配置相应的第三方信息</p>
                </div -->
                
                 <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="control-group" style="color:#929292;margin-top:10px;">
                           <a class="btn btn-info btn-large" style="margin-right:20px;" href="/weorder/create?wid=<?=$wid?>">添加</a>
                    	</div>
                </div>
                
				<div class="box-content">
					<div class="panel panel-default">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>活动名称</th>
									<th>关键词</th>
									<th>创建时间</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($model as $item){?>
							<tr>
                            	<td style="text-align:center;">
                                    <p><?= $item->title?></p>
								</td>
								<td style="vertical-align:middle;">
									<?= $item->key?>
								</td>
                               	<td style="vertical-align:middle;">
                               		<?=date('Y-m-d H:i:s', $item->create_at)?>
                                 </td>
                                 <td style="vertical-align:middle;">
										<a class="btn btn-default" href="/weorder/update?id=<?=$item->id?>&wid=<?=$wid?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                    </td>
                            </tr>
                            <?php }?>
                            <tr>
                            	<td colspan="4" class="text-right">
                            		<?= LinkPager::widget(['pagination' => $page]); ?>
                            	</td>
							</tr>
                           </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
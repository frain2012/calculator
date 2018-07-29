<?php
use yii\widgets\LinkPager;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '登录日志';
?>
<div class="container-fluid">
		<div class="row-fluid">
			<div class="box">
				<div class="box-title">
					<h3>
						<span class="glyphicon glyphicon-th" aria-hidden="true"></span><?=$this->title?>
					</h3>
				</div>
				<div class="box-content">
					<div class="panel panel-default">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>IP</th>
									<th>描述</th>
									<th>创建时间</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($model as $item){?>
							<tr>
                            	<td>
                                    <p><?=$item->ip?></p>
								</td>
								<td>
									<?=$item->desc?>
								</td>
                                 <td>
                                    <?= date('Y-m-d H:i:s', $item->created_at)?>
                                 </td>
                            </tr>
                            <?php }?>
                            <tr>
                            	<td colspan="6" class="text-right">
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
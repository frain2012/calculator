<?php
use yii\helpers\Html;
use yii\helpers\Url;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '后台管理系统';
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
    <?=Html::cssFile('@web/css/bootstrap.css')?>
    <?=Html::cssFile('@web/css/main.css')?>
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php $this->beginBody()?>
    <!-- 导航部分 -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="javascript:void(0);"><?=Yii::$app->params['website']['name']?></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="javascript:void(0);">管理平台</a></li>
					<li><a href="javascript:void(0);">消息</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
					</li>
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						(<?= Yii::$app->user->identity->username?>)
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=Url::to(['site/logout']);?>">退出</a></li>
						</ul></li>
				</ul>
			</div>
		</div>
	</nav>
    <!-- 主体部分-->
    <div class="container-fluid">
    	<div class="left">
	        <div class="menu">我的帐号</div>
	      	<ul class="nav nav-sidebar">
	            <li><a href="<?=Url::to(['account/passwd']);?>" target="mainFrame">修改密码</a></li>
	            <li class="active"><a href="<?=Url::to(['account/wechat']);?>" target="mainFrame">公众帐号管理</a></li>
	        </ul>
	        <div class="menu">支付管理</div>
	      	<ul class="nav nav-sidebar">
	            <li><a href="<?=Url::to(['account/wxpay']);?>" target="mainFrame">微信支付</a></li>
	        </ul>
	        <div class="menu">日志管理</div>
	      	<ul class="nav nav-sidebar">
	            <li><a href="<?=Url::to(['account/log']);?>" target="mainFrame">查看日志</a></li>
	        </ul>
      </div>
      <div class="right">
      	<iframe frameborder="0" id="mainFrame" name="mainFrame" src="<?=Url::to(['account/wechat']);?>"></iframe>
      </div>
    </div>
	<?=Html::jsFile('@web/js/jquery.js')?>
	<?=Html::jsFile('@web/js/bootstrap.js')?>
	<?=Html::jsFile('@web/js/main.js')?>
    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
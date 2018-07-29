<?php
use yii\helpers\Html;
use yii\helpers\Url;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
$this->title = '帐号管理系统';
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
					<li><a href="#"><span class="glyphicon glyphicon-home"
							aria-hidden="true"></span></a></li>
					<li class="dropdown"><a href="javascript:void(0);"
						class="dropdown-toggle" data-toggle="dropdown" role="button"
						aria-haspopup="true" aria-expanded="false">
							<?=$model->name?><img src="<?=$model->head?>?imageView2/0/w/20">
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/account/main">帐号管理</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="/wechat/index/aid/<?=$model->id?>">帐号信息</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="/site/logout">退出</a></li>
						</ul></li>
				</ul>
			</div>
		</div>
	</nav>
    <!-- 主体部分-->
    <div class="container-fluid">
    	<div class="left">
        	<div class="subnav">
                <div class="subnav-title first-subnav">
                    <a href="javascript:void(0)" class="toggle-subnav">
                    	<em ><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span></em>
						<span class="title">基础服务</span>
						<span class="caret"></span>
					</a>
				</div>
                <ul class="subnav-menu" data='0' style="display:none;">
                	<li>
						<div class="subnav-title first-subnav">
							<a href="/reply/subscribe?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">关注回复</span>
							</a>
						</div>
					</li>
					<li>
						<div class="subnav-title first-subnav">
							<a href="/material/list?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">图文素材</span>
							</a>
						</div>
					</li>
                	<li>
						<div class="subnav-title first-subnav">
							<a href="/reply/keywordlist?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">关键词回复</span>
							</a>
						</div>
					</li>
                    <li>
						<div class="subnav-title first-subnav">
							<a href="/menus/list?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">自定义菜单</span>
							</a>
						</div>
					</li>
                  </ul>
            </div>
            
            <div class="subnav">
                <div class="subnav-title first-subnav">
                    <a href="javascript:void(0)" class="toggle-subnav">
                    	<em><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></em>
						<span class="title">营销推广</span>
						<span class="caret"></span>
					</a>
				</div>
				
                <ul class="subnav-menu" data='0' style="display:none;">
                	<li>
						<div class="subnav-title first-subnav">
							<a href="/money/list?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">现金红包</span>
							</a>
						</div>
					</li>
					<li>
						<div class="subnav-title first-subnav">
							<a href="/weorder/list?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">大转盘</span>
							</a>
						</div>
					</li>
					<li>
						<div class="subnav-title first-subnav">
							<a href="/weorder/store?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">兑奖商品</span>
							</a>
						</div>
					</li>
                  </ul>
            </div>
            <div class="subnav">
                <div class="subnav-title first-subnav">
                    <a href="javascript:void(0)" class="toggle-subnav">
                    	<em><span class="glyphicon glyphicon-oil" aria-hidden="true"></span></em>
						<span class="title">系统设置</span>
						<span class="caret"></span>
					</a>
				</div>
				
                <ul class="subnav-menu" data='0' style="display:none;">
                	<li>
						<div class="subnav-title first-subnav">
							<a href="/wechat/set?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">授权设置</span>
							</a>
						</div>
					</li>
					<li>
						<div class="subnav-title first-subnav">
							<a href="/open/index?wid=<?=$model->id?>" class="toggle-subnav" target="mainFrame">
								<span class="padding">开放平台</span>
							</a>
						</div>
					</li>
                  </ul>
            </div>
      	</div>
      <div class="right">
      	<iframe frameborder="0" id="mainFrame" name="mainFrame" src="/wechat/main/aid/<?=$model->id?>"></iframe>
      </div>
    </div>
	<?=Html::jsFile('@web/js/jquery.js')?>
	<?=Html::jsFile('@web/js/bootstrap.js')?>
	<?=Html::jsFile('@web/js/main.js')?>
    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
<?php
use yii\helpers\Html;

$this->title = $name;
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
    <link href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="padding-top:40px;padding-bottom:40px;background-color:#eee;">
    <?php $this->beginBody()?>
    <div class="jumbotron">
		<div class="container">
			<div class="jumbotron">
	          <h1><?=$exception->getMessage()?></h1>
	        </div>
		</div>
	</div>
    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>

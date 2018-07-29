<?php
use yii\helpers\Html;

/**
 * 主要的应用
 * @var \yii\web\View $this
 * @var string $content
 */
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
    <?=Html::cssFile('@web/css/datetimepicker.css')?>
    <?=Html::cssFile('@web/css/style.css')?>
    <?=Html::jsFile('@web/js/jquery.js')?>
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php $this->beginBody()?>
    <?= $content ?>
    <?php $this->endBody()?>
	<?=Html::jsFile('@web/js/bootstrap.js')?>
	<?=Html::jsFile('@web/js/datetimepicker.js')?>
	<?=Html::jsFile('@web/js/Validform.min.js')?>
	<?=Html::jsFile('@web/js/form.js')?>
</body>
</html>
<?php $this->endPage()?>

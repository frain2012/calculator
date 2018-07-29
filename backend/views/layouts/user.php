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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
    <?=Html::cssFile('@web/css/usr/bootstrap.min.css')?>
    <?=Html::cssFile('@web/css/usr/style.css')?>
    <?=Html::jsFile('@web/js/jquery.min.js')?>
    <?=Html::jsFile('@web/js/bootstrap.js')?>
    <?=Html::jsFile('@web/js/vue.js')?>
    <?=Html::jsFile('@web/js/jquery.nicescroll.js')?>
    <?=Html::jsFile('@web/js/usr/event.js')?>
    <?=Html::cssFile('@web/css/font-awesome.min.css')?>
</head>
<body>
<div class="wrap">
    <aside class="nav-wrap">
        <div class="navbar-fir navbar-fixed-side">
            <a href="javascript:" class="navbar-toggle" data-target="#hdtnavbar" data-toggle="collapse"><span class="glyphicon glyphicon-th-large"></span></a>
            <div class="brand">
                <a href="javascript:;">
                    <div class="brand-logo avatar-text"> </div>
                    <h5 class="brand-name text-nowrap"><?=substr_replace(Yii::$app->user->identity->tel,'****',3,4);?></h5>
                </a>
            </div>

            <nav id="hdtnavbar">
                <ul>
                    <li class="active"><a href="/account/home"><span class="glyphicon glyphicon-home"></span>设置</a></li>
                    <li class=""><a href="/account/list"><span class="glyphicon glyphicon-user"></span>账号</a></li>
                    <li class=""><a href="/site/logout"><span class="glyphicon glyphicon-off"></span>退出</a></li>
                </ul>
            </nav>
        </div><!--end .navbar-fir-->
    </aside><!--end .nav-wrap-->

    <div class="main-wrap">

        <?php $this->beginBody()?>
        <?= $content ?>
        <?php $this->endBody()?>


        <div class="footer" id="footer">
            <p>© 2018 虎虎生威</p>
        </div>

    </div><!--end .main-wrap-->
</div>

</body>
</html>
<?php $this->endPage()?>

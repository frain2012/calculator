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
                <a href="/account/switch">
                    <div class="brand-logo avatar-text"> </div>
                    <h5 class="brand-name text-nowrap"> 指尖合肥</h5>
                </a>
            </div>

            <nav id="hdtnavbar">
                <ul>
                    <li class="active"><a href="/account/home"><span class="glyphicon glyphicon-home"></span>首页</a></li>
                    <li class=""><a href="/v2/plug"><span class="glyphicon glyphicon-th-large"></span>应用</a></li>
                    <li class=""><a href="/v2/order"><span class="glyphicon glyphicon-list-alt"></span>订单</a></li>
                    <li class=""><a href="/setting/biz"><span class="glyphicon glyphicon-edit"></span>设置</a></li>
                    <li class=""><a href="/v2/capital/balance"><span class="glyphicon glyphicon-yen"></span>资产</a></li>
                    <li class=""><a href="/account/password"><span class="glyphicon glyphicon-user"></span>账号</a></li>

                    <li class=""><a href="/account/switch"><span class="glyphicon glyphicon-transfer"></span>切换</a></li>
                    <li class=""><a href="/site/logout"><span class="glyphicon glyphicon-off"></span>退出</a></li>
                </ul>
            </nav>
        </div><!--end .navbar-fir-->

        <div class="navbar-sec navbar-fixed-side" tabindex="1" style="overflow: hidden; outline: none;">
            <a href="javascript:" class="navbar-sec-name" data-target="#hdtappbar" data-toggle="collapse">集福袋(H5)</a>
            <nav id="hdtappbar">
                <ul>
                    <li class="active"><a href="/plug/ysfudai">应用详请</a></li>
                    <li><a href="/plug/ysfudai/subject/list">专题</a></li>
                    <li><a href="/plug/ysfudaiconfig">基础配置</a></li>
                </ul>
            </nav>
        </div>
    </aside><!--end .nav-wrap-->

    <div class="main-wrap">

        <?php $this->beginBody()?>
        <?= $content ?>
        <?php $this->endBody()?>

        <div class="footer" id="footer">
            <p>咨询电话微信：18950008486</p>
            <p>© 2018 好店通版权所有 闽ICP备16002731号</p>
        </div>
    </div><!--end .main-wrap-->
</div>

</body>
</html>
<?php $this->endPage()?>

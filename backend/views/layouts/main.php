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
    <?=Html::cssFile('@web/css/bootstrap.css')?>
    <?=Html::cssFile('@web/css/style.css')?>
    <?=Html::jsFile('@web/js/jquery.2.2.0.min.js')?>
</head>
<body>

<div class="wrap">
    <div class="main-wrap">
        <div class="app app-equal-mainwrap">
            <div class="app-inner">

                <div class="brand-wrap">
                    <h1 class="brand" href="javascript:"><img src="../../img/brand.hdt.comb.svg" alt="好店通"></h1>
                    <p class="brand-title">选择品牌</p>
                    <div class="brand-side">
                        <?=substr_replace(Yii::$app->user->identity->tel,'****',3,4);?>
                        <small class="text-muted"> - </small>
                        <a href="/site/logout">退出</a>
                    </div>
                </div>
                <div class="page-header">

                    <div class="row">

                        <div class="col-sm-8 text-center">

                            <form class="form-horizontal">
                                <input type="hidden" name="type" value="biz">
                                <div class="form-group">
                                    <div class="col-xs-6 col-md-offset-4"><input type="text" class="form-control " placeholder="搜索商家、自媒体" name="name" value=""></div>
                                    <div class="col-xs-2"><button type="submit" class="btn btn-default btn-block">搜索</button></div>
                                </div>

                            </form>

                        </div>

                        <div class="col-sm-4 text-right">
                            <a href="/account/biz" class="btn btn-success">新建</a>
                        </div>

                    </div>

                </div>
                <div class="para-title">
                    <h3>我的公众号</h3>
                    <p class="para-title-side text-muted">点击公众号进入同城圈、五折卡、或好店商城管理</p>
                </div>

                <div class="row">

                    <ul class="thumbnails list-unstyled">
                        <li class="col-xs-12 col-md-3">
                            <a class="thumbnail" href="?to=<?=Yii::$app->user->identity->id;?>">
                                <div class="caption">
                                    <h4 class="text-nowrap"><?=Yii::$app->user->identity->brand;?></h4>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>


                <div class="para-title">
                    <h3>我管理的商家</h3>
                    <p class="para-title-side text-muted"></p>
                </div>

                <?php $this->beginBody()?>
                <?= $content ?>
                <?php $this->endBody()?>

            </div><!--end .app-inner-->
        </div><!--end .app-->
        <div class="footer" id="footer"><p>© 2016 好店通版权所有 闽ICP备16002731号</p></div>
    </div><!--end .main-wrap-->
</div>
<?=Html::jsFile('@web/js/bootstrap.js')?>
<?=Html::jsFile('@web/js/event.js')?>
</body>
</html>
<?php $this->endPage()?>

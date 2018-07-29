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
    <?=Html::cssFile('@web/css/base.css')?>
    <?=Html::cssFile('@web/css/style.css')?>
</head>
<body>
<nav class="header">
    <div class="container">
        <a class="brand" href="javascript:"><img src="./img/brand.hdt.comb.svg" alt="好店通"/></a>
        <ul class="nav">
            <li class="active"><a href="javascript:">首页</a></li>
            <li><a href="#solution">解决方案</a></li>
            <li><a href="#case">客户案例</a></li>
            <li><a href="#contact">联系我们</a></li>
            <li><a href="http://e.haodiantong.cn" class="btn btn-stroke" target="_blank">登录</a></li>
            <li><a href="http://e.haodiantong.cn/register" class="btn" target="_blank">免费注册</a></li>
        </ul>
    </div>
</nav>
<div class="product role-wxapp">
    <div class="container">
        <ul class="product-nav">
            <li class="product-nav-item role-wxapp active"><a href="javasctipt:">新小店</a></li>
            <li class="product-nav-item role-blackcard"><a href="javasctipt:">黑卡</a></li>
            <li class="product-nav-item role-mall"><a href="javasctipt:">好店商城</a></li>
            <li class="product-nav-item role-city"><a href="javasctipt:">同城圈</a></li>
            <li class="product-nav-item role-bargin"><a href="javasctipt:">砍价</a></li>
            <li class="product-nav-item role-taskpost"><a href="javasctipt:">裂变海报</a></li>
            <li class="product-nav-item role-discountcard"><a href="javasctipt:">五折卡</a></li>
        </ul>
        <ul class="product-list">
            <li class="product-list-item role-wxapp">
                <h3>新小店</h3>
                <p>面向自媒体的小程序电商服务平台，为自媒体提供开店、选品、供应链、内容、客服、数据分析等完整 电商服务。深度融入微信去中心化的生态，帮助自媒体实现粉丝变现和营收增长。</p>
                <p><a href="http://www.xinxiaodian.com" class="btn" target="_blank">了解详情</a></p>
            </li>
            <li class="product-list-item role-blackcard">
                <h3>黑卡</h3>
                <p>以会员特权和大牌抢购为核心的粉丝服务系统，支持吃货节、亲子卡等多种业务模式，适用于区域自媒体深度服务付费粉丝。</p>
                <p><a href="http://e.haodiantong.cn" class="btn" target="_blank">立即开通</a></p>
            </li>
            <li class="product-list-item role-mall">
                <h3>好店商城</h3>
                <p>同城消费电商解决方案，支持秒杀抢购玩法，支持到店核销、物流发货等完整业务流程，开通简单快捷，配置即可使用。</p>
                <p><a href="http://e.haodiantong.cn" class="btn" target="_blank">立即开通</a></p>
            </li>
            <li class="product-list-item role-city">
                <h3>同城圈</h3>
                <p>区域自媒体同城生活消费平台，包括本地分类信息和商家入驻两大模块，支持红包营销、服务号通知、自动结算等功能。</p>
                <p><a href="http://e.haodiantong.cn" class="btn" target="_blank">立即开通</a></p>
            </li>
            <li class="product-list-item role-bargin">
                <h3>砍价</h3>
                <p>功能强大的裂变营销工具，快速传播和吸粉解决方案，多家知名区域自媒体和商家品牌的共同选择，包括吸粉版和营销版。
                </p>
                <p><a href="http://e.haodiantong.cn" class="btn" target="_blank">立即开通</a></p>
            </li>
            <li class="product-list-item role-taskpost">
                <h3>裂变海报</h3>
                <p>高功能强大的裂变营销工具，以海报的形式快速传播，支持吸粉功能，支持达到底价后支付购买，海报关注更安全。</p>
                <p><a href="http://e.haodiantong.cn" class="btn" target="_blank">立即开通</a></p>
            </li>
            <li class="product-list-item role-discountcard">
                <h3>五折卡</h3>
                <p>有成熟运营经验，系统支持合作商家定期提供特惠福利给粉丝，用户端开卡方式支持直接付费购买和激活码开通。</p>
                <p><a href="http://e.haodiantong.cn" class="btn" target="_blank">立即开通</a></p>
            </li>
        </ul>
    </div>
</div>
<?php $this->beginBody()?>
<?= $content ?>
<?php $this->endBody()?>
<footer class="footer">
    <div class="container">
        <div class="support" id="contact">
            <div class="support-item">
                <h3>厦门好店通科技有限公司</h3>
                <p>好店通立足于区域自媒体生态，为各城市公众号提供同城生活消费SaaS系统，涵盖吸粉推广、交易核销、会员特权等业务场景。新小店是公司推出的全新小程序电商产品，赋能自媒体电商业务。</p>
            </div>
            <div class="support-item">
                <h3>联系我们</h3>
                <p>地址：厦门软件园二期望海路31号5楼</p>
                <p>电话：18950008486</p>
                <p><img class="qrcode" src="./img/qrcode.jpeg"></p>
            </div>
        </div>
        <p class="copyright">Copyrignt &copy;2017 厦门好店通科技有限公司版权所有 闽ICP备11018888号-7</p>
    </div>
</footer>
<?=Html::jsFile('@web/js/jquery.2.2.0.min.js')?>
</body>
</html>
<?php $this->endPage()?>

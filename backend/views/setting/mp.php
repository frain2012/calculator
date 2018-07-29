<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = '切换-商家中心';
?>
    <div class="breadcrumb">
        <a href="/v2">首页</a>
        <span class="text-muted">/</span>
        <a href="/v2/setting">设置</a>
        <span class="text-muted">/</span>
        <span class="text-muted">门店管理</span>
    </div>


<div class="app">
    <div class="app-inner">

        <div class="para-title"><h3>公众号列表</h3></div>
        <div class="alert alert-warning" style=" margin-top: 10px">

            <p>
                <span class="text-warning">配置吸粉类型的营销活动(如砍价)时，从以下列表选择参与活动的公众号</span><br>
                <span class="text-warning">请确保您添加的认证公众号账号主体与好店通的签约公司名称一致，否则无法通过审核</span>
            </p>

        </div>

        <p>
            <a href="/setting/mpedit" class="btn btn-primary">新增公众号</a>
        </p>

        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th>公众号名称</th>
                <th>公众号二维码</th>
                <th>时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!is_null($model)){ foreach($model as $item){?>
                <tr>
                    <td><?=$item->name;?></td>
                    <td><img src="<?=$item->qrcode;?>" width="100" height="100" alt=""></td>
                    <td>上传时间<br><?=$item->time;?></td>
                    <td></td>
                </tr>
            <?php } }?>
            </tbody>
        </table>
        <nav class="text-center">
            <?= LinkPager::widget(['pagination' => $pages]); ?>
        </nav>
    </div><!--end .app-inner-->
</div>
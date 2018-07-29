<?php
use yii\helpers\Html;


$this->title = '切换-商家中心';
?>
<table class="table table-hover table-striped">
    <colgroup>
        <col width="20%">
        <col width="15%">
        <col width="15%">
        <col width="">
    </colgroup>

    <tbody>
    <tr>
        <td><strong>峰冉文化</strong></td>
        <td>0家门店</td>
        <td>
            18019553656<br>
        </td>
        <td class="text-right">
            <a href="?to=14232" class="btn btn-primary btn-sm">进入管理</a>
        </td>
    </tr>
    </tbody>
</table>
<nav class="text-center">
    <ul class="pagination">
        <li class="disabled"><a href="javascript:void(0)">共30条</a></li>
        <li class="active"><a href="/v2/account/switch?type=biz&amp;name=&amp;page=1">1</a></li>
        <li><a href="/v2/account/switch?type=biz&amp;name=&amp;page=2">2</a></li>
        <li><a href="/v2/account/switch?type=biz&amp;name=&amp;page=2">»</a></li>
    </ul>
</nav>

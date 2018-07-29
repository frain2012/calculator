<?php 
$name = empty($_POST['name']) ? "" : trim($_POST['name']);
$id = empty($_POST['id']) ? "" : trim($_POST['id']);
$ids = empty($_POST['ids']) ? "" : trim($_POST['ids']);
$content = empty($_POST['content']) ? "" : trim($_POST['content']);
if (empty($name) ||  empty($id)){
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
<title>母亲节为妈咪颁奖</title>
<link type="text/css" rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/1.3.0/css/frozen.css">
<script type="text/javascript" src="jquery.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body ontouchstart="">
<header class="ui-header ui-header-positive ui-border-b">
	<h1>宇宙妈咪大赛奖状</h1>
</header>
<section class="ui-container">
	<img src="icon.jpg" width="50%" style="margin:40px 25%">
	<div class="ui-form ui-border-t">
    	<form action="" method="post">
        	<div class="ui-form-item ui-border-b">
            	<label>姓名</label>
            	<input type="text" name="name" placeholder="输入你的姓名">
        	</div>
        	<div class="ui-form-item ui-border-b">
            	<label>奖项</label>
            	<div class="ui-select">
                	<select name="id" id="id">
                    	<option value="1">最唠叨妈咪</option>
                    	<option value="2">无敌宠孙妈咪</option>
                    	<option value="3">最勤劳妈咪</option>
                    	<option value="4">最美丽妈咪</option>
                    	<option value="5">最贤惠妈咪</option>
                    	<option value="6">金牌理财妈咪</option>
                    	<option value="7">超级食神妈咪</option>
                    	<option value="8">最佳口才妈咪</option>
                    	<option value="9">最美围裙妈咪</option>
                    	<option value="10">故事大王妈咪</option>
                    	<option value="11">超级学霸妈咪</option>
                    	<option value="12">最潮妈咪</option>
                    	<option value="13">自定义</option>
                	</select>
            	</div>
        	</div>
        	<div class="ui-form-item ui-border-b" id="other" style="display:none;">
            	<label>自定义</label>
            	<input type="text" name="ids" placeholder="请输入奖项" maxlength="6">
        	</div>
        	<div class="ui-form-item ui-border-b">
            	<label>表白</label>
            	<input type="text" name="content" placeholder="自己填写，可不填写">
        	</div>
			<div class="ui-btn-wrap">
    			<button class="ui-btn-lg ui-btn-primary" type="submit">确定</button>
			</div>
    	</form>
	</div>
</section>
<script type="text/javascript">
$(function($) {
	$('#id').change( function() {
		var id = $(this).val();
		if(id =="13"){
			$('#other').fadeIn();
		}else{
			$('#other').fadeOut();
		}
	});
});
</script>
<footer class="ui-footer ui-footer-btn">
	<ul class="ui-tiled ui-border-t">
		<li class="ui-border-r"><a href="javascript:;"><div>更多装逼功能</div></a></li>
	</ul>
</footer>
<div style="display: none;">
	<script src="http://s5.cnzz.com/stat.php?id=5835588&web_id=5835588" language="JavaScript"></script>
</div>
</body>
</html>
<?php 
}else{
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
<title>母亲节为妈咪颁奖</title>
<link type="text/css" rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/1.3.0/css/frozen.css" />
</head>
<body ontouchstart="">
<header class="ui-header ui-header-positive ui-border-b">
	<h1>长按下方图片点选保存图片</h1>
</header>
<section class="ui-container">
	<img src="image.php?name=<?php echo $name;?>&id=<?php echo $id;?>&ids=<?php echo $ids;?>&content=<?php echo $content;?>" width="100%">
</section>
<div style="display: none;">
	<script src="http://s5.cnzz.com/stat.php?id=5835588&web_id=5835588" language="JavaScript"></script>
</div>
</body>
</html>
<?php }?>
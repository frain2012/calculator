<?php
$name = empty($_GET['name']) ? "":trim($_GET['name']);
$id = empty($_GET['id']) ? "":trim($_GET['id']);
$ids = empty($_GET['ids']) ? "":trim($_GET['ids']);
$id = intval($id);
$array = array("最唠叨妈咪","无敌宠孙妈咪","最勤劳妈咪","最美丽妈咪","最贤惠妈咪","金牌理财妈咪","超级食神妈咪","最佳口才妈咪","最美围裙妈咪","故事大王妈咪","超级学霸妈咪","最潮妈咪");
if($id >=1 && $id <=12){
	$ids = $array[$id-1];
}
$content = empty($_GET['content']) ? "":trim($_GET['content']);
$dst_path = 'bg.jpg';
$dst = imagecreatefromstring(file_get_contents($dst_path));

$font = 'msyhbd.ttc';
//$font = 'simsun.ttc';
//文字
$black = imagecolorallocate($dst, 0, 0, 0);
imagefttext($dst, 12, 0, 85, 162, $black, $font, $name);
//称号
$cname = imagecolorallocate($dst, 0, 0, 0);
imagefttext($dst, 14, 0, 137, 226, $cname, $font, $ids);

//表白
if(!empty($content)){
	$cb = imagecolorallocate($dst, 0, 0, 0);
	imagefttext($dst, 12, 0, 95, 300, $cb, 'simsun.ttc', $content);
}
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
switch ($dst_type) {
	case 1:
		header('Content-Type: image/gif');
		imagegif($dst);
		break;
	case 2:
		header('Content-Type: image/jpeg');
		imagejpeg($dst);
		break;
	case 3:
		header('Content-Type: image/png');
		imagepng($dst);
		break;
	default:
		break;
}
imagedestroy($dst);

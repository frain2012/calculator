<?php
use yii\helpers\Html;


$this->title = '安徽省伤亡赔偿计算器';
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<title><?= Html::encode($this->title)?></title>
	<?php $this->head()?>
	<?=Html::cssFile('@web/css/base.css')?>
	<?=Html::jsFile('@web/js/jquery.2.2.0.min.js')?>
</head>
<body>
<div class="container">
	<div class="title">安徽省伤亡赔偿计算器</div>
	<div class="top">
		<div class="h1">请您选择：</div>
		<div class="product mainltr">
			<input class="form-check-input" type="radio" name="type" value="1" checked onclick="onType(1);">城镇伤残
			<input class="form-check-input" type="radio" name="type" value="2" onclick="onType(2);">农村伤残
			<input class="form-check-input" type="radio" name="type" value="3" onclick="onType(3);">城镇死亡
			<input class="form-check-input" type="radio" name="type" value="4" onclick="onType(4);">农村死亡
			<input class="form-check-input" type="radio" name="type" value="5" onclick="onType(5);">门诊
			<input class="form-check-input" type="radio" name="type" value="6" onclick="onType(6);">住院
		</div>
		<!--伤残赔偿算法--->
		<div class="block" id="t1">
			<form id="tf1" method="post">
				<ul class="calc1_zuhe">
					<li>
						<label class="font">实际天数：</label>
						<input name="day" maxlength="8" size="8" type="text" class="input1"/>/天<label class="red">*</label>
					</li>
					<li>
						<label class="font">实际月工资：</label>
						<input name="money" maxlength="8" size="8" type="text" class="input1"/>/月<label class="red">*</label>
					</li>
					<li>
						<label class="font">年龄：</label>
						<input name="age" type="text" class="input1"/><label class="red">*</label>&nbsp;&nbsp;&nbsp;&nbsp;
					</li>
					<li>
						<label class="font">是否住院：</label>
						<select name="live" class="select1">
							<option value="">请选择</option>
							<option value="1">是</option>
							<option value="2">否</option>
						</select>
						<label class="red">*</label>&nbsp;&nbsp;&nbsp;
					</li>
					<li>
						<label class="font">伤残等级：</label>
						<select name="grade" class="select1">
							<option value="">请选择</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
						<label class="red">*</label>&nbsp;&nbsp;&nbsp;
					</li>
				</ul>
			</form>
		</div>
		<!--死亡赔偿算法--->
		<div class="none" id="t2">
			<form id="tf2">
				<ul class="calc1_zuhe">
					<li>
						<label class="font">实际天数：</label>
						<input name="day" maxlength="8" size="8" type="text" class="input1"/>/天<label class="red">*</label>
					</li>
					<li>
						<label class="font">实际月工资：</label>
						<input name="money" maxlength="8" size="8" type="text" class="input1"/>/月<label class="red">*</label>
					</li>
					<li>
						<label class="font">年龄：</label>
						<input name="age" type="text" class="input1"/><label class="red">*</label>&nbsp;&nbsp;&nbsp;&nbsp;
					</li>
					<li>
						<label class="font">是否住院：</label>
						<select name="live" class="select1">
							<option value="">请选择</option>
							<option value="1">是</option>
							<option value="2">否</option>
						</select>
						<label class="red">*</label>&nbsp;&nbsp;&nbsp;
					</li>
					<li>
						<label class="font">责任比例：</label>
						<select name="scale" class="select1">
							<option value="">请选择</option>
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="25">25</option>
							<option value="30">30</option>
							<option value="35">35</option>
							<option value="40">40</option>
							<option value="45">45</option>
							<option value="50">50</option>
							<option value="55">55</option>
							<option value="60">60</option>
							<option value="65">65</option>
							<option value="70">70</option>
							<option value="75">75</option>
							<option value="80">80</option>
							<option value="85">85</option>
							<option value="90">90</option>
							<option value="95">95</option>
							<option value="100">100</option>
						</select>
						<label class="red">*</label>&nbsp;&nbsp;&nbsp;
					</li>
					<li>
						<label class="font">被抚养类型：</label>
						<select name="grade" id="grade" class="select1" onchange="grades()">
							<option value="">无</option>
							<option value="1">子女</option>
							<option value="2">父母</option>
						</select>
						&nbsp;&nbsp;&nbsp;
					</li>
					<li id="years" style="display:none;">
						<label class="font">被抚养人年龄：</label>
						<input name="year" id="year" type="text" class="input1"/>
						<label class="red">*</label>&nbsp;&nbsp;&nbsp;
					</li>
				</ul>
			</form>
		</div>
		<!---门诊、住院--->
		<div class="none" id="t3">
			<form id="tf3">
				<ul class="calc1_zuhe">
					<li>
						<label class="font">实际天数：</label>
						<input name="day" maxlength="8" size="8" type="text" class="input1"/>/天<label class="red">*</label>
					</li>
					<li>
						<label class="font">实际月工资：</label>
						<input name="money" maxlength="8" size="8" type="text" class="input1"/>/月<label class="red">*</label>
					</li>
			</form>
		</div>
		<div style="text-align: center;margin:10px 5px;">
			<a href="javascript:void(0);" onclick="ajaxResult();">
				<img src="/images/jsc.gif"/>
			</a>
		</div>
	</div>

	<div class="bottom" style="background-color: #fff;">
		<div class="h1">查看结果：</div>
		<div class="mainrtr01">
			<ul class="calc1_zuhe">
				<li>
					<label class="font">计算结果如下:</label>
					<input id="pcmoney" type="text" class="input1" readonly="true">元
				</li>
			</ul>
		</div>
		<div id="str" style="text-align:center;"></div>
		<div style="text-align:center;">*以上结果仅供参考 </div>
	</div>

</div>
<script>
	$.fn.serializeObject = function()
	{
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name] !== undefined) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
	function onType(tval) {
		if(tval==1 || tval==2){
			$('#t1').show();
			$('#t2').hide();
			$('#t3').hide();
		}else if(tval==3 || tval==4){
			$('#t1').hide();
			$('#t2').show();
			$('#t3').hide();
		}else{
			$('#t1').hide();
			$('#t2').hide();
			$('#t3').show();
		}
		$('#pcmoney').val("");
	}
	function grades() {
		var grade = $("#grade").val();
		if(grade==1 || grade==2){
			$("#years").show();
		}else{
			$("#years").hide();
			$("#year").val("");
		}
	}
	function ajaxResult() {
		var type = $("input[name='type']:checked").val();
		var data;
		if(type==1 || type==2){
			data=$('#tf1').serializeObject()
		}else if(type==3 || type==4){
			data=$('#tf2').serializeObject()
		}else{
			data=$('#tf3').serializeObject()
		}
		data.type=type;
		$.ajax({
			url: '/site/calulator',
			type: 'post',
			dataType: 'json',
			data: data,
			success: function(datas) {
				if(datas.status==0){
					$('#pcmoney').val(datas.data);
					$('#str').text(datas.str);
				}else{
					alert(datas.msg);
				}
			}
		});
	}
</script>
<!--<footer class="footer">
	<p class="copyright">Copyrignt &copy;2018 虎虎生威</p>
</footer>-->
</body>
</html>
<?php $this->endPage()?>
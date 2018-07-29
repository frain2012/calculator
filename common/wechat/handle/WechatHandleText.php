<?php

namespace common\wechat\handle;

use Yii;
use common\models\money\MoneyData;
use common\models\money\MoneyUser;
use common\wechat\WechatReply;

/**
 * 微信文本处理
 * @author Administrator
 *
 */
class WechatHandleText{
    
	private  $account = null;
	private $receive = null;
	
	private $reply = null;
	
	
	public function __construct($account=NULL,$receive=NULL) {
		$this->account = $account;
		if ($this->reply === null){
			$this->reply = new WechatReply($receive);
		}
	}
	
	/**
	 * 处理点击文本事件
	 */
	public function handle(){
		$content = $this->reply->getRevContent();
		if ($money = MoneyData::findOne(['key'=>$content])){
			$date = date('Y-m-d');
			if ($date < $money->sdate){
				$this->reply->text('活动日期还未开始')->reply();
			}else if ($date > $money->edate){
				$this->reply->text('活动日期已经结束')->reply();
			}else{
				$time = date('H:i');
				if ($time < $money->stime){
					$this->reply->text('活动时间还未开始')->reply();
				}elseif ($time > $money->etime){
					$this->reply->text('活动时间已经结束')->reply();
				}else{
					$openid = $this->reply->getRevFrom();
					switch ($money->type){
						case 0:
							$num = MoneyUser::find()->where(['openid'=>$openid,'mid'=>$money->id])->count();
							if ($num >= $money->num){
								$this->reply->text('您没有机会')->reply();
								return ;
							}
							$user = new MoneyUser();
							$user->openid = $openid;
							$user->mid = $money->id;
							if ($user->save()){
								$this->reply->text('<a href="http://www.huoz.cn/webmoney?id='.$money->id.'&openid='.$openid.'">点击领取</a>')->reply();
								return ;
							}
							$this->reply->text('系统繁忙，请稍后再试~~~')->reply();
							return ;
						case 1:
							$this->reply->text('暂时还未开通此功能')->reply();
							return ;
						case 2:
							$this->reply->text('暂时还未开通此功能')->reply();
							return ;
					}
				}
			}
		}
	}
}


<?php

namespace common\wechat;

use Yii;
use common\models\user\Wechat;
use common\wechat\handle\WechatHandleEvent;
use common\wechat\handle\WechatHandleText;

class WechatEngine{
    
    private $request = null;
    private $account = null;
    private $receive = null;
    private $postxml;
    
    
    public function __construct() {
        if ($this->request === null){
            $this->request = Yii::$app->request;
        }
        if ($token = $this->request->get('t')){
        	$this->account = Wechat::findOne(['mpurl'=>$token]);
        }
    }
    
    /**
     * 处理操作
     */
    public function handle(){
    	if ($this->account){
    		if ($this->checkSignature()){
    			return;
    		}
    		$msgType = $this->getRev()->getRevType();
    		switch ($msgType){
    			case Constant::MSGTYPE_EVENT:
    				//点击事件
    				$event = new WechatHandleEvent($this->account,$this->receive);
    				$event->handle();
    				break;
    			case Constant::MSGTYPE_TEXT:
    				//文本事件
    				$text = new WechatHandleText($this->account,$this->receive);
    				$text->handle();
    				break;
    			case Constant::MSGTYPE_IMAGE:
    				//图片
    				break;
    			case Constant::MSGTYPE_VOICE:
    				//语音
    				break;
    			case Constant::MSGTYPE_VIDEO:
    				//视频
    				break;
    			case Constant::MSGTYPE_SHORTVIDEO:
    				//小视频
    				break;
    			case Constant::MSGTYPE_LOCATION:
    				//地理位置
    				break;
    			case Constant::MSGTYPE_LINK:
    				//短链接地址
    				break;
    			default:
    				return;
    		}
    	}
    }
    
    /**
     * 微信绑定
     */
    public function checkSignature(){
    	if ($this->request->get('echostr')) {
    		$echostr = $this->request->get ( 'echostr' );
    		$signature = $this->request->get ( 'signature' );
    		$timestamp = $this->request->get ( 'timestamp' );
    		$nonce = $this->request->get ( 'nonce' );
    		$tmpArr = array ($this->account->mptoken,$timestamp,$nonce);
    		sort ( $tmpArr, SORT_STRING );
    		$tmpStr = implode ( $tmpArr );
    		$tmpStr = sha1 ( $tmpStr );
    		if ($tmpStr == $signature) {
    			echo $echostr;
    			return true;
    		}
    		return false;
    	}
    }
    
    /**
     * 获取微信服务器发来的信息
     */
    public function getRev() {
    	if ($this->receive) return $this;
    	libxml_disable_entity_loader(true);
    	$postStr = !empty($this->postxml) ? $this->postxml : file_get_contents("php://input");
    	
    	
    	$postStr = '<xml><ToUserName><![CDATA[gh_462a7e789a30]]></ToUserName>
    	<FromUserName><![CDATA[o9IX3wqHJmh2NQsGET9N-HpH-7tk]]></FromUserName>
    	<CreateTime>'.time().'</CreateTime>
    	<MsgType><![CDATA[text]]></MsgType>
    	<Content><![CDATA[cccc]]></Content>
    	<MsgId>6257086061487414741</MsgId>
    	</xml>';
    	
    	/* $open=fopen("log_".time().".txt","a" );
    	fwrite($open,$postStr);
    	fclose($open); */
    	
    	
    	if (!empty($postStr)) {
    		$this->receive = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    	}
    	return $this;
    }
    
    /**
     * 获取微信服务器发来的信息
     */
    public function getRevData()
    {
    	return $this->receive;
    }
    
    /**
     * 获取接收消息的类型
     */
    public function getRevType() {
    	if (isset($this->receive['MsgType']))
    		return $this->receive['MsgType'];
    	else
    		return false;
    }
}


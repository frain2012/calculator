<?php

namespace common\wechat\handle;

use Yii;
use common\wechat\WechatReply;

/**
 * 微信事件处理
 * @author Administrator
 *
 */
class WechatHandleEvent{
    
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
     * 处理点击时间
     */
    public function handle(){
    	
    }
}


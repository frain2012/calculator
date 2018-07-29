<?php

namespace common\wechat;

use Yii;
use common\util\WechatUtil;

/**
 * 微信支付
 * @author Administrator
 *
 */
class WechatPay{
    
	const JSAPIPAY='https://api.mch.weixin.qq.com/pay/unifiedorder';
	
    private $wxpay;
    
    public function __construct($wxpay=NULL) {
        $this->wxpay = $wxpay;
    }
    
    /**
     * 网页授权
     * @param unknown $AppID
     * @param unknown $url
     * @return string
     */
    public function wechatSnsapi_userinfo() {
    	$url = WechatUtil::getUrl();
    	return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->wxpay->appid . '&redirect_uri=' . $url . '&response_type=code&scope=snsapi_base&state=state#wechat_redirect';
    }
    
    /**
     * 通过code换取网页授权access_token
     * @param unknown $AppID
     * @param unknown $AppSecret
     * @param unknown $code
     * @return boolean|unknown|number
     */
    public function wechatAuthorizeCode($code) {
    	$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->wxpay->appid . '&secret=' .$this->wxpay->appsecret. '&code=' . $code . '&grant_type=authorization_code';
    	$result = self::wchatCurlGet ( $url );
    	if ($result){
    		$json = json_decode($result,true);
    		if (!$json || !empty($json['errcode'])) {
    			return false;
    		}
    		return $json;
    	}
    	return false;
    }
    
    /*** 微信基础接口****/
    public static function wchatCurlGet($url) {
    	$curl = curl_init ();
    	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $curl, CURLOPT_TIMEOUT, 300 );
    	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
    	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
    	curl_setopt ( $curl, CURLOPT_URL, $url );
    	$res = curl_exec ( $curl );
    	curl_close ( $curl );
    	return $res;
    }
    
    public static function wchatCurlPost($data,$url=self::JSAPIPAY) {
    	$curl = curl_init ();
    	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $curl, CURLOPT_TIMEOUT, 300 );
    	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
    	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
    	curl_setopt ( $curl, CURLOPT_URL, $url );
    	curl_setopt	( $curl, CURLOPT_POSTFIELDS, $data );
    	$res = curl_exec ( $curl );
    	curl_close ( $curl );
    	return $res;
    }
}


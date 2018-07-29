<?php
namespace common\util;


use Yii;
use common\models\base\TBusinessShare;
use common\models\WxPay;

class WechatUtil
{
	/**
	 * 生成微信绑定后台的URl和Token
	 * @param unknown $id
	 */
	public static function createWechatUrl(){
		$array = array();
		$STR = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
		$array['url'] = self::getUUID();
		$array['token'] = mt_rand(1000,9999).'_'.$STR[mt_rand(0,25)];
		return $array;
	}
	
	public static function getUUID(){
		return md5(uniqid(rand(), true));
	}
	
	public static function getUrl(){
		$protocol = (! empty ( $_SERVER ['HTTPS'] ) && $_SERVER ['HTTPS'] !== 'off' || $_SERVER ['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		return $url;
	}
	
	
	
	
	
	public static function  createNonceStr($length = 4) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for($i = 0; $i < $length; $i ++) {
			$str .= substr ( $chars, mt_rand ( 0, strlen ( $chars ) - 1 ), 1 );
		}
		return $str;
	}
	
	/**
	 * 创建自定义菜单数
	 */
	public static function creatMenu($data,$level=1){
	    $tree = array();
	    foreach($data as $k => $v){
	        if ($v->level == $level){
	            $sub = self::createSubMenu($data,$v->id);
	            $temp = array();
	            if (count($sub) > 0){
	                $temp['name'] = $v->name;
	                $temp['sub_button'] = $sub;
	                $tree[] = $temp;
	            }else{
	                $temp['name'] = $v->name;
	                switch ($v->type){
	                    case 1:
	                        $temp['type'] = 'click';
	                        $temp['key'] = $v->content;
	                        break;
	                    case 2:
	                        $temp['type'] = 'view';
	                        $temp['url'] = $v->content;
	                        break;
	                }
	                $tree[] = $temp;
	            }
	        }
	    }
	    return array('button'=>$tree);
	}
	
	public static function createSubMenu($data,$pid,$level=2){
	    $tree = array();
	    foreach($data as $k => $v){
	        if (($v->level === $level) && ($v->pid === $pid)){
	            $temp['name'] = $v->name;
	            switch ($v->type){
	                case 1:
	                    $temp['type'] = 'click';
	                    $temp['key'] = $v->content;
	                    break;
	                case 2:
	                    $temp['type'] = 'view';
	                    $temp['url'] = $v->content;
	                    break;
	            }
	            $tree[] = $temp;
	        }
	    }
	    return $tree;
	}
	
	/**
	 * 生成
	 */
	public static function createMenuTree($data,$pid,$level=1){
		$tree = array();
		foreach($data as $k => $v){
			if($v->parent == $pid){
				$v->parent = self::createMenuTree($data,$v->id,$level+1);
				$temp['id'] = $v->id;
				$temp['name'] = $v->name;
				$temp['level'] = $level;
				$temp['route'] = $v->route;
				$temp['parent'] = $v->parent;
				$temp['order'] = $v->order;
				$tree[] = $temp;
			}
		}
		return $tree;
	}
	
	/**
	 *权限表-生成tree
	 */
	public static function createPermissionTree($data,$pid,$level=1){
		$tree = array();
		foreach($data as $k => $v){
			if($v->parent == $pid){
				$v->parent = self::createMenuTree($data,$v->id,$level+1);
				$temp['id'] = $v->id;
				$temp['name'] = $v->name;
				$temp['level'] = $level;
				$temp['route'] = $v->route;
				$temp['parent'] = $v->parent;
				$temp['order'] = $v->order;
				$tree[] = $temp;
			}
		}
		return $tree;
	}
	
	/*** 微信基础接口****/
	public static function wchatCurlGet($url) {
	    $curl = curl_init ();
	    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	    curl_setopt ( $curl, CURLOPT_TIMEOUT, 300 );
	    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
	    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
	    curl_setopt ( $curl, CURLOPT_URL, $url);
	    $res = curl_exec ( $curl );
	    curl_close ( $curl );
	    return $res;
	}
	
	public static function wchatCurlPost($url,$data) {
	    $curl = curl_init ();
	    curl_setopt ( $curl, CURLOPT_URL, $url );
	    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	    curl_setopt ( $curl, CURLOPT_TIMEOUT, 300 );
	    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
	    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
	    curl_setopt ( $curl, CURLOPT_POST, true );
	    curl_setopt ( $curl, CURLOPT_HEADER, false );
	    curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data );
	    $res = curl_exec ( $curl );
	    curl_close ( $curl );
	    return $res;
	    /* 
	    
	    
	    
	    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	    curl_setopt ( $curl, CURLOPT_TIMEOUT, 300 );
	    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
	    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
	    
	    curl_setopt ( $ch, CURLOPT_POST, true );
	    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	    
	    curl_setopt ( $curl, CURLOPT_URL, $url);
	    $res = curl_exec ( $curl );
	    curl_close ( $curl );
	    return $res; */
	}
	
	public static function getGlobal($appid='',$appsecret=''){
	    $result = self::wchatCurlGet('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret);
	    if ($result)
	    {
	        $json = json_decode($result,true);
	        if (!$json || !empty($json['errcode'])) {
	            return false;
	        }
	        return $json;
	    }
	    return false;
	}
	
	public static function getTicket($access_token){
	    $result = self::wchatCurlGet('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi');
	    if ($result)
	    {
	        $json = json_decode($result,true);
	        if (!$json || !empty($json['errcode'])) {
	            return false;
	        }
	        return $json;
	    }
	    return false;
	}
	
	public static function getAccessToken($appid='',$appsecret='') {
	    if (empty($appid) || empty($appsecret)){
	        return false;
	    }
	    $wechat =TBusinessShare::findOne(['appid'=>$appid,'appsecret'=>$appsecret]);
	    if ($wechat){
	        $time = $wechat->token_expires;
	        if ($time < time()){
	            $json = self::getGlobal($appid,$appsecret);
	            if ($json){
	                $wechat->access_token =$json['access_token'];
	                $wechat->token_expires =$json['expires_in']+time();
	                $wechat->save();
	                return $json['access_token'];
	            }
	            return false;
	        }
	        return $wechat->access_token;
	    }else{
	        $json = self::getGlobal($appid,$appsecret);
	        if ($json){
	            $wechat->appid = $appid;
	            $wechat->appsecret = $appsecret;
	            $wechat->access_token =$json['access_token'];
	            $wechat->token_expires =$json['expires_in']+time();
	            $wechat->save();
	            return $json['access_token'];
	        }
	        return false;
	    }
	}
	
	public static function createNewMenu($tree,$apid,$appsecrt){
	    $token = self::getAccessToken($apid,$appsecrt);
	    if ($token){
	        $url = self::MENU.$token;
	        $result = self::wchatCurlPost($url, json_encode($tree,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
	        if ($result){
	            $json = json_decode($result,true);
	            if (!$json || !empty($json['errcode'])) {
	                return $json;
	            }
	            return 2;
	        }
	        return 1;
	    }
	    return 0;
	}
	
	public static function getJsapiTicket($appid='',$appsecret=''){
	    if (empty($appid) || empty($appsecret)){
	        return false;
	    }
	    $wechat =TBusinessShare::findOne(['appid'=>$appid,'appsecret'=>$appsecret]);
	    if ($wechat){
	        if ($wechat->ticket_expires < time()){
	            if (($access_token = self::getAccessToken($appid,$appsecret)) && ($json = self::getTicket($access_token))){
	                $wechat->jsapi_ticket = $json['ticket'];
	                $wechat->ticket_expires = $json['expires_in']+time();
	                $wechat->save();
	                return $json['ticket'];
	            }
	            return false;
	        }
	        return $wechat->jsapi_ticket;
	    }else{
	        if (($jsonToken = self::getGlobal($appid,$appsecret)) && ($jsonTicket = self::getTicket($jsonToken['access_token']))){
	            $token = new Token();
	            $token->appid = $appid;
	            $token->appsecret = $appsecret;
	            $token->jsapi_ticket = $jsonTicket['ticket'];
	            $token->ticket_expires = $jsonTicket['expires_in']+time();
	            $token->access_token =$jsonToken['access_token'];
	            $token->token_expires =$jsonToken['expires_in']+time();
	            $token->save();
	            return $jsonTicket['ticket'];
	        }
	    }
	}
	
	public static function getTicketSignature($arry) {
	    $jsapiTicket = self::getJsapiTicket($arry['appid'],$arry['appsecret']);
	    $url = self::getUrl();
	    $timestamp = time();
	    $nonceStr = self::createNonceStr(16);
	    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
	    $signature = sha1 ( $string );
	    $signPackage = array (
	        "appId" => $arry['appid'],
	        "nonceStr" => $nonceStr,
	        "timestamp" => $timestamp,
	        "url" => $url,
	        "signature" => $signature
	    );
	    return $signPackage;
	}
	/****
	 * 
	 */
	/**
	 * 网页授权
	 * @param unknown $AppID
	 * @param unknown $url
	 * @return string
	 */
	public static function wechatSnsapi_snsapi_base() {
	    $url = self::getUrl();
	    return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . \Yii::$app->params['wxpay']['appid'] . '&redirect_uri=' . $url . '&response_type=code&scope=snsapi_base&state=state#wechat_redirect';
	}
	/**
	 * 网页授权
	 * @param unknown $AppID
	 * @param unknown $url
	 * @return string
	 */
	public static function wechatSnsapi_userinfo() {
	    $url = urlencode(self::getUrl());
	    return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . \Yii::$app->params['wxpay']['appid'] . '&redirect_uri=' . $url . '&response_type=code&scope=snsapi_userinfo&state=state#wechat_redirect';
	}



	/**
	 * 通过code换取网页授权access_token
	 */
	public static function wechatAuthorizeCode($code) {
	    $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . \Yii::$app->params['wxpay']['appid'] . '&secret=' . \Yii::$app->params['wxpay']['appsecret'] . '&code=' . $code . '&grant_type=authorization_code';
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

    /**
     * userinfo
     */
    public static function userinfo($openid,$access_token) {
        $url = 'https://api.weixin.qq.com/sns/userinfo?lang=zh_CN&openid=' . $openid . '&access_token='.$access_token;
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
	
	/**
	 * 生成订单号
	 * @return string
	 */
	public static function getPayMchBillno() {
	    $str = date ( 'YmdHis' );
	    $rand = mt_rand ( 0, 9999 );
	    if ($rand < 10) {
	        $str .= '000' . $rand;
	    } else if ($rand < 100) {
	        $str .= '00' . $rand;
	    } else if ($rand < 1000) {
	        $str .= '0' . $rand;
	    } else {
	        $str .= $rand;
	    }
	    return \Yii::$app->params['wxpay']['mchid'] . $str;
	}
	
	public static function wechatPaySign($Obj) {
	    foreach ( $Obj as $k => $v ) {
	        $Parameters [$k] = $v;
	    }
	    ksort ($Parameters);
	    $String = self::formatBizQueryParaMap ($Parameters, false );
	    $String = $String . "&key=" . \Yii::$app->params['wxpay']['key'];
	    $String = md5 ( $String );
	    $result = strtoupper ( $String );
	    return $result;
	}
	
	
	public static function formatBizQueryParaMap($paraMap, $urlencode) {
	    $buff = "";
	    ksort ( $paraMap );
	    foreach ( $paraMap as $k => $v ) {
	        if ($urlencode) {
	            $v = urlencode ( $v );
	        }
	        $buff .= $k . "=" . $v . "&";
	    }
	    $reqPar = '';
	    if (strlen ( $buff ) > 0) {
	        $reqPar = substr ( $buff, 0, strlen ( $buff ) - 1 );
	    }
	    return $reqPar;
	}
	
	public static function arrayToXml($arr) {
	    $xml = "<xml>";
	    foreach ( $arr as $key => $val ) {
	        if (is_numeric ( $val )) {
	            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
	        } else
	            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
	    }
	    $xml .= "</xml>";
	    return $xml;
	}
	
	public static function wchatSSLPost($xml,$url=self::CPAY){
	    $ch = curl_init ();
	    curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
	    curl_setopt ( $ch, CURLOPT_URL, $url );
	    curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	    curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
	    curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
	    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	    // 设置证书
	    $path = dirname(YII::$app->basePath).DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'cert'.DIRECTORY_SEPARATOR;
	    
	    curl_setopt ( $ch, CURLOPT_SSLCERT, $path.'apiclient_cert.pem');
	    curl_setopt ( $ch, CURLOPT_SSLKEY, $path.'apiclient_key.pem');
	    curl_setopt ( $ch, CURLOPT_CAINFO, $path.'rootca.pem');
	    // post提交方式
	    curl_setopt ( $ch, CURLOPT_POST, true );
	    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xml );
	    $data = curl_exec ( $ch );
	    // 返回结果
	    if ($data) {
	        curl_close ( $ch );
	        return $data;
	    } else {
	        $error = curl_errno ( $ch );
	        echo "curl出错，错误码:$error" . "<br>";
	        echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
	        curl_close ( $ch );
	        return false;
	    }
	}
	
	/**
	 * 发起支付
	 * @param unknown $user
	 * @return boolean
	 */
	public static function getPayParamets($openid='',$money=1){
	    $data['mch_id'] = \Yii::$app->params['wxpay']['mchid'];
	    $data['wxappid'] = \Yii::$app->params['wxpay']['appid'];
	    $data['mch_billno'] = self::getPayMchBillno();
	    $data['nonce_str'] = self::createNonceStr(32);
	    $data['send_name'] = \Yii::$app->params['wxpay']['name'];
	    $data['re_openid'] = $openid;
	    $data['total_amount'] = $money;
	    $data['total_num'] = 1;
	    $data['wishing'] = \Yii::$app->params['wxpay']['wishing'];
	    $data['client_ip'] = Yii::$app->request->userIP;;
	    $data['act_name'] = \Yii::$app->params['wxpay']['name'];
	    $data['remark'] = \Yii::$app->params['wxpay']['name'];
	    $data['sign'] = self::wechatPaySign($data);
	    $pay = new WxPay();
	    $pay->setAttributes($data);
	    if ($pay->save()){
	        $temp = self::arrayToXml ($data);
	        $res = self::wchatSSLPost($temp);
	        $json = self::xmlToArray($res);
	        if ($json['return_code'] == 'SUCCESS'){
	            $pay->return_code = $json['return_code'];
	            $pay->save();
	            return true;
	        }else{
	            $pay->return_code = $json['return_code'];
	            $pay->desc = $json['return_msg'];
	            $pay->save();
	            return false;
	        }
	    }
	    return false;
	}
	
	public static function xmlToArray($xml) {
	    $array_data = json_decode ( json_encode ( simplexml_load_string ( $xml, 'SimpleXMLElement', LIBXML_NOCDATA ) ), true );
	    return $array_data;
	}
}
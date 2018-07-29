<?php

namespace common\wechat;

use Yii;

/**
 * 微信回复
 * @author Administrator
 *
 */
class WechatReply{
    
    private $receive = null;
    private $_funcflag = false;
    private $_text_filter = true;
    private $_msg;
    
    public function __construct($receive=NULL) {
        $this->receive = $receive;
    }
    
    /*****************************获取内容************************************/
    
    /**
     * 获取消息发送者
     */
    public function getRevFrom() {
    	if (isset($this->receive['FromUserName']))
    		return $this->receive['FromUserName'];
    	else
    		return false;
    }
    
    /**
     * 获取消息接受者
     */
    public function getRevTo() {
    	if (isset($this->receive['ToUserName']))
    		return $this->receive['ToUserName'];
    	else
    		return false;
    }
    
    /**
     * 获取消息ID
     */
    public function getRevID() {
    	if (isset($this->receive['MsgId']))
    		return $this->receive['MsgId'];
    	else
    		return false;
    }
    
    /**
     * 获取消息发送时间
     */
    public function getRevCtime() {
    	if (isset($this->receive['CreateTime']))
    		return $this->receive['CreateTime'];
    	else
    		return false;
    }
    
    /**
     * 获取接收消息内容正文
     */
    public function getRevContent(){
    	if (isset($this->receive['Content']))
    		return $this->receive['Content'];
    	else if (isset($this->receive['Recognition'])) //获取语音识别文字内容，需申请开通
    		return $this->receive['Recognition'];
    	else
    		return false;
    }
    
    /**
     * 获取接收消息图片
     */
    public function getRevPic(){
    	if (isset($this->receive['PicUrl']))
    		return array(
    				'mediaid'=>$this->receive['MediaId'],
    				'picurl'=>(string)$this->receive['PicUrl'],    //防止picurl为空导致解析出错
    		);
    		else
    			return false;
    }
    
    /**
     * 获取接收消息链接
     */
    public function getRevLink(){
    	if (isset($this->receive['Url'])){
    		return array(
    				'url'=>$this->receive['Url'],
    				'title'=>$this->receive['Title'],
    				'description'=>$this->receive['Description']
    		);
    	} else
    		return false;
    }
    
    /**
     * 获取接收地理位置
     */
    public function getRevGeo(){
    	if (isset($this->receive['Location_X'])){
    		return array(
    				'x'=>$this->receive['Location_X'],
    				'y'=>$this->receive['Location_Y'],
    				'scale'=>$this->receive['Scale'],
    				'label'=>$this->receive['Label']
    		);
    	} else
    		return false;
    }
    
    /**
     * 获取上报地理位置事件
     */
    public function getRevEventGeo(){
    	if (isset($this->receive['Latitude'])){
    		return array(
    				'x'=>$this->receive['Latitude'],
    				'y'=>$this->receive['Longitude'],
    				'precision'=>$this->receive['Precision'],
    		);
    	} else
    		return false;
    }
    
    /**
     * 获取接收事件推送
     */
    public function getRevEvent(){
    	if (isset($this->receive['Event'])){
    		$array['event'] = $this->receive['Event'];
    	}
    	if (isset($this->receive['EventKey'])){
    		$array['key'] = $this->receive['EventKey'];
    	}
    	if (isset($array) && count($array) > 0) {
    		return $array;
    	} else {
    		return false;
    	}
    }
    
    /**
     * 获取自定义菜单的扫码推事件信息
     *
     * 事件类型为以下两种时则调用此方法有效
     * Event	 事件类型，scancode_push
     * Event	 事件类型，scancode_waitmsg
     *
     * @return: array | false
     * array (
     *     'ScanType'=>'qrcode',
     *     'ScanResult'=>'123123'
     * )
     */
    public function getRevScanInfo(){
    	if (isset($this->receive['ScanCodeInfo'])){
    		if (!is_array($this->receive['ScanCodeInfo'])) {
    			$array=(array)$this->receive['ScanCodeInfo'];
    			$this->receive['ScanCodeInfo']=$array;
    		}else {
    			$array=$this->receive['ScanCodeInfo'];
    		}
    	}
    	if (isset($array) && count($array) > 0) {
    		return $array;
    	} else {
    		return false;
    	}
    }
    
    
    /*************************设置发送内容*********************************/
    
    /**
     * 设置发送消息
     * @param array $msg 消息数组
     * @param bool $append 是否在原消息数组追加
     */
    public function Message($msg = '',$append = false){
    	if (is_null($msg)) {
    		$this->_msg =array();
    	}elseif (is_array($msg)) {
    		if ($append)
    			$this->_msg = array_merge($this->_msg,$msg);
    		else
    			$this->_msg = $msg;
    		return $this->_msg;
    	} else {
    		return $this->_msg;
    	}
    }
    
    /**
     * 设置回复文本消息
     * Example: $obj->text('hello')->reply();
     * @param string $text
     */
    public function text($text='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>Constant::MSGTYPE_TEXT,
    			'Content'=>$this->_auto_text_filter($text),
    			'CreateTime'=>time(),
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    /**
     * 设置回复图片消息
     * Example: $obj->image('media_id')->reply();
     * @param string $mediaid
     */
    public function image($mediaid='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>Constant::MSGTYPE_IMAGE,
    			'Image'=>array('MediaId'=>$mediaid),
    			'CreateTime'=>time(),
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    
    /**
     * 设置回复语音消息
     * Example: $obj->voice('media_id')->reply();
     * @param string $mediaid
     */
    public function voice($mediaid='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>Constant::MSGTYPE_VOICE,
    			'Voice'=>array('MediaId'=>$mediaid),
    			'CreateTime'=>time(),
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    
    /**
     * 设置回复视频消息
     * Example: $obj->video('media_id','title','description')->reply();
     * @param string $mediaid
     */
    public function video($mediaid='',$title='',$description='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>Constant::MSGTYPE_VIDEO,
    			'Video'=>array(
    					'MediaId'=>$mediaid,
    					'Title'=>$title,
    					'Description'=>$description
    			),
    			'CreateTime'=>time(),
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    
    /**
     * 设置回复音乐消息
     * @param string $title
     * @param string $desc
     * @param string $musicurl
     * @param string $hgmusicurl
     * @param string $thumbmediaid 音乐图片缩略图的媒体id，非必须
     */
    public function music($title,$desc,$musicurl,$hgmusicurl='',$thumbmediaid='') {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'CreateTime'=>time(),
    			'MsgType'=>Constant::MSGTYPE_MUSIC,
    			'Music'=>array(
    					'Title'=>$title,
    					'Description'=>$desc,
    					'MusicUrl'=>$musicurl,
    					'HQMusicUrl'=>$hgmusicurl
    			),
    			'FuncFlag'=>$FuncFlag
    	);
    	if ($thumbmediaid) {
    		$msg['Music']['ThumbMediaId'] = $thumbmediaid;
    	}
    	$this->Message($msg);
    	return $this;
    }
    
    /**
     * 设置回复图文消息
     * @param array $newsData
     * 数组结构:
     *  array(
     *  	"0"=>array(
     *  		'Title'=>'msg title',
     *  		'Description'=>'summary text',
     *  		'PicUrl'=>'http://www.domain.com/1.jpg',
     *  		'Url'=>'http://www.domain.com/1.html'
     *  	),
     *  	"1"=>....
     *  )
     */
    public function news($newsData=array())
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$count = count($newsData);
    
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>Constant::MSGTYPE_NEWS,
    			'CreateTime'=>time(),
    			'ArticleCount'=>$count,
    			'Articles'=>$newsData,
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    
    /**
     *
     * 回复微信服务器, 此函数支持链式操作
     * Example: $this->text('msg tips')->reply();
     * @param string $msg 要发送的信息, 默认取$this->_msg
     * @param bool $return 是否返回信息而不抛出到浏览器 默认:否
     */
    public function reply($msg=array(),$return = false)
    {
    	if (empty($msg)) {
    		if (empty($this->_msg))   //防止不先设置回复内容，直接调用reply方法导致异常
    			return false;
    		$msg = $this->_msg;
    	}
    	$xmldata=  $this->xml_encode($msg);
    	if ($return)
    		return $xmldata;
    	else
    		echo $xmldata;
    }
    
    /**
     * 过滤文字回复\r\n换行符
     * @param string $text
     * @return string|mixed
     */
    private function _auto_text_filter($text) {
    	if (!$this->_text_filter) return $text;
    	return str_replace("\r\n", "\n", $text);
    }
    
    /**
     * XML编码
     * @param mixed $data 数据
     * @param string $root 根节点名
     * @param string $item 数字索引的子节点名
     * @param string $attr 根节点属性
     * @param string $id   数字索引子节点key转换的属性名
     * @param string $encoding 数据编码
     * @return string
     */
    public function xml_encode($data, $root='xml', $item='item', $attr='', $id='id', $encoding='utf-8') {
    	if(is_array($attr)){
    		$_attr = array();
    		foreach ($attr as $key => $value) {
    			$_attr[] = "{$key}=\"{$value}\"";
    		}
    		$attr = implode(' ', $_attr);
    	}
    	$attr   = trim($attr);
    	$attr   = empty($attr) ? '' : " {$attr}";
    	$xml   = "<{$root}{$attr}>";
    	$xml   .= self::data_to_xml($data, $item, $id);
    	$xml   .= "</{$root}>";
    	return $xml;
    }
    
    /**
     * 数据XML编码
     * @param mixed $data 数据
     * @return string
     */
    public static function data_to_xml($data) {
    	$xml = '';
    	foreach ($data as $key => $val) {
    		is_numeric($key) && $key = "item id=\"$key\"";
    		$xml    .=  "<$key>";
    		$xml    .=  ( is_array($val) || is_object($val)) ? self::data_to_xml($val)  : self::xmlSafeStr($val);
    		list($key, ) = explode(' ', $key);
    		$xml    .=  "</$key>";
    	}
    	return $xml;
    }
    
    public static function xmlSafeStr($str)
    {
    	return '<![CDATA['.preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/",'',$str).']]>';
    }
}


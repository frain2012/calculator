<?php

namespace common\wechat;

use Yii;

/**
 * 微信图片处理
 * @author Administrator
 *
 */
class WechatHandleImage{
    
    private  $account = null;
    private $receive = null;
    
    
    public function __construct($account=NULL,$receive=NULL) {
        $this->account = $account;
        $this->receive = $receive;
    }
    
    /**
     * 设置回复消息
     * Example: $obj->text('hello')->reply();
     * @param string $text
     */
    public function text($text='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>self::MSGTYPE_TEXT,
    			'Content'=>$this->_auto_text_filter($text),
    			'CreateTime'=>time(),
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    /**
     * 设置回复消息
     * Example: $obj->image('media_id')->reply();
     * @param string $mediaid
     */
    public function image($mediaid='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>self::MSGTYPE_IMAGE,
    			'Image'=>array('MediaId'=>$mediaid),
    			'CreateTime'=>time(),
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    
    /**
     * 设置回复消息
     * Example: $obj->voice('media_id')->reply();
     * @param string $mediaid
     */
    public function voice($mediaid='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>self::MSGTYPE_VOICE,
    			'Voice'=>array('MediaId'=>$mediaid),
    			'CreateTime'=>time(),
    			'FuncFlag'=>$FuncFlag
    	);
    	$this->Message($msg);
    	return $this;
    }
    
    /**
     * 设置回复消息
     * Example: $obj->video('media_id','title','description')->reply();
     * @param string $mediaid
     */
    public function video($mediaid='',$title='',$description='')
    {
    	$FuncFlag = $this->_funcflag ? 1 : 0;
    	$msg = array(
    			'ToUserName' => $this->getRevFrom(),
    			'FromUserName'=>$this->getRevTo(),
    			'MsgType'=>self::MSGTYPE_VIDEO,
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
     * 设置回复音乐
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
    			'MsgType'=>self::MSGTYPE_MUSIC,
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
     * 设置回复图文
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
    			'MsgType'=>self::MSGTYPE_NEWS,
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
}


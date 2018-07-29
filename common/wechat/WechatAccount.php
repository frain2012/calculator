<?php

namespace common\wechat;

use Yii;

abstract  class WechatAccount
{
    private $account = null;
    
    public static function create($token = '') {
        if(!empty($token)) {
            
        }
    }
    
    public static function valid(){
        $request = Yii::$app->request;
        if (! empty ( $request->get ( 'echostr' ) )) {
            $echostr = $request->get ( 'echostr' );
            $signature = $request->get ( 'signature' );
            $timestamp = $request->get ( 'timestamp' );
            $nonce = $request->get ( 'nonce' );
            $tmpArr = array ("",$timestamp,$nonce);
            sort ( $tmpArr, SORT_STRING );
            $tmpStr = implode ( $tmpArr );
            $tmpStr = sha1 ( $tmpStr );
            if ($tmpStr == $signature) {
                echo $echostr;
                return ;
            } else {
                return ;
            }
        }
    }
}


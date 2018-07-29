<?php

namespace common\models\wxpay;

use Yii;

/**
 * 微信支付
 * @author Administrator
 *
 */
class WxPay extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'wxpay';
    }

    public function rules()
    {
        return [
            [['aid', 'type'], 'integer'],
            [['appid', 'mchid'], 'string', 'max' => 18],
            [['appsecret', 'key'], 'string', 'max' => 32],
            [['rootca', 'apiclientkey', 'apiclientcert'], 'string', 'max' => 255]
        ];
    }
    
    public function scenarios()
    {
    	return [
    		'create' =>['aid', 'type','appid','mchid','appsecret','key','rootca','apiclientkey','apiclientcert'],
    		'update' =>['type','appid','mchid','appsecret','key','rootca','apiclientkey','apiclientcert'],
    	];
    }
}

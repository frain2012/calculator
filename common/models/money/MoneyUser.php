<?php

namespace common\models\money;

use Yii;
use yii\db\ActiveRecord;

/**
 * 营销模块-现金红包(用户数据表)
 * @author Administrator
 *
 */
class MoneyUser extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 't_money_user';
    }
    
    public function behaviors()
    {
    	return [
	    	'timestamp' => [
	    		'class' => 'yii\behaviors\TimestampBehavior',
		    	'attributes' => [
		    		ActiveRecord::EVENT_BEFORE_INSERT => ['create_at'],
		    	],
    		],
    	];
    }

    public function rules()
    {
        return [
            [['money'], 'number'],
            [['status', 'issuccess', 'create_at', 'update_at','mid'], 'integer'],
            [['openid', 'wechat'], 'string', 'max' => 28],
            [['nickname'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 2],
            [['city', 'province', 'country'], 'string', 'max' => 50],
            [['headimgurl'], 'string', 'max' => 200]
        ];
    }
}

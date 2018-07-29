<?php

namespace common\models\money;

use Yii;
use yii\db\ActiveRecord;

/**
 * 营销模块-现金红包(配置设置)
 * @author Administrator
 *
 */
class MoneyData extends ActiveRecord
{
    public static function tableName()
    {
        return 't_money_data';
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
            [['total', 'smoney', 'mmoney'], 'number'],
            [['isarea', 'type', 'num', 'create_at','wid'], 'integer'],
            [['name', 'key'], 'string', 'max' => 100],
            [['sdate', 'edate'], 'string', 'max' => 10],
            [['stime', 'etime'], 'string', 'max' => 6],
            [['area'], 'string', 'max' => 255],
            ['aid', 'default', 'value' => Yii::$app->user->identity->id],
        ];
    }
    
    public function scenarios()
    {
    	return [
    		'create' =>['total', 'smoney','mmoney','isarea','type','num','name','key','sdate','edate','stime','etime','area','aid'],
    		'update' =>['total', 'smoney','mmoney','isarea','type','num','name','key','sdate','edate','stime','etime','area'],
    	];
    }
}

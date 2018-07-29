<?php

namespace common\models\user;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\WechatBehavior;

class Wechat extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'wechat';
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['uid', 'created_at', 'updated_at','type'], 'integer'],
            [['mpid', 'appid'], 'string', 'max' => 18],
            [['appsecrt', 'mpurl'], 'string', 'max' => 32],
            [['domain','name','head'], 'string', 'max' => 100],
            [['mptoken'], 'string', 'max' => 15],
        ];
    }
    
    public function scenarios()
    {
        return [
            'create' => ['uid', 'name','mpid','appid','appsecrt','head','wurl','wtoken','type'],
            'update' => ['name','head','appid','appsecrt','type'],
            'set' => ['type','appid','appsecrt'],
        ];
    }

    
}

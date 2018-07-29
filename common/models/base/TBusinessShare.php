<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_share".
 *
 * @property integer $bid
 * @property string $name
 * @property string $appid
 * @property string $appsecret
 * @property string $auth
 * @property string $access_token
 * @property string $jsapi_ticket
 * @property integer $token_expires
 * @property integer $ticket_expires
 */
class TBusinessShare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_share';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid','ticket_expires','token_expires'], 'integer'],
            [['appid', 'appsecret', 'auth','name'], 'string', 'max' => 125],
            [['access_token'], 'string', 'max' => 255],
            [['jsapi_ticket'], 'string', 'max' => 512]
        ];
    }

    public function scenarios()
    {
        return [
            'setInfo'=>['bid','appid','appsecret','auth','name']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bid' => 'Bid',
            'appid' => 'Appid',
            'appsecret' => 'Appsecret',
            'auth' => 'Auth',
        ];
    }
}

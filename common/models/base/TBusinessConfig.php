<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_config".
 *
 * @property string $id
 * @property integer $bid
 * @property integer $type
 * @property string $merchant
 * @property string $key
 * @property string $appsecret
 * @property string $appcert
 * @property string $privatekey
 */
class TBusinessConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid'], 'required'],
            [['bid', 'type'], 'integer'],
            [['merchant', 'key', 'appsecret'], 'string', 'max' => 125],
            [['appcert', 'privatekey'], 'string', 'max' => 2000]
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
            'type' => 'Type',
            'merchant' => 'Merchant',
            'key' => 'Key',
            'appsecret' => 'Appsecret',
            'appcert' => 'Appcert',
            'privatekey' => 'Privatekey',
        ];
    }
}

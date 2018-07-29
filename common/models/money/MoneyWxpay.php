<?php

namespace common\models\money;

use Yii;

/**
 * 营销模块-现金红包(支付表)
 * @author Administrator
 *
 */
class MoneyWxpay extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 't_money_wxpay';
    }

    public function rules()
    {
        return [
            [['total_amount', 'total_num', 'pid'], 'integer'],
            [['mch_billno'], 'string', 'max' => 28],
            [['nonce_str', 'sign', 'mch_id', 'wxappid', 'send_name', 're_openid', 'act_name'], 'string', 'max' => 32],
            [['wishing'], 'string', 'max' => 128],
            [['client_ip'], 'string', 'max' => 15],
            [['remark', 'desc'], 'string', 'max' => 256],
            [['return_code'], 'string', 'max' => 16]
        ];
    }

}

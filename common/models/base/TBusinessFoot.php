<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_foot".
 *
 * @property string $id
 * @property integer $bid
 * @property string $info
 * @property string $qrcode
 */
class TBusinessFoot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_foot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid'], 'integer'],
            [['info', 'qrcode'], 'string', 'max' => 255]
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
            'info' => 'Info',
            'qrcode' => 'Qrcode',
        ];
    }
}

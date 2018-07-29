<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_qrcode".
 *
 * @property string $id
 * @property integer $bid
 * @property string $name
 * @property string $qrcode
 * @property string $time
 *
 */
class TBusinessQrcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_qrcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid'], 'required'],
            [['bid'], 'integer'],
            [['name'], 'string', 'max' => 125],
            [['time'], 'string', 'max' => 30],
            [['qrcode'], 'string', 'max' => 255]
        ];
    }

    public function scenarios()
    {
        return [
            'setAdd'=>['bid','name','qrcode','time'],
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
            'name' => 'Name',
            'qrcode' => 'Qrcode',
        ];
    }
}

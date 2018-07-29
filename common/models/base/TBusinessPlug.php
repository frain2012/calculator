<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_plug".
 *
 * @property integer $bid
 * @property integer $tpid
 */
class TBusinessPlug extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_plug';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid', 'tpid'], 'required'],
            [['bid', 'tpid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bid' => 'Bid',
            'tpid' => 'Tpid',
        ];
    }
}

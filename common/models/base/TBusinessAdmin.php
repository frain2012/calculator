<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_admin".
 *
 * @property string $id
 * @property integer $bid
 * @property string $tel
 * @property string $logintime
 * @property integer $type
 */
class TBusinessAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid', 'tel'], 'required'],
            [['bid', 'type'], 'integer'],
            [['logintime'], 'safe'],
            [['tel'], 'string', 'max' => 125]
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
            'tel' => 'Tel',
            'logintime' => 'Logintime',
            'type' => 'Type',
        ];
    }
}

<?php

namespace common\models\fudai;

use Yii;

/**
 * This is the model class for table "t_plug_fudai_base".
 *
 * @property string $id
 * @property integer $bid
 * @property string $name
 * @property string $telphone
 * @property string $telpeople
 * @property string $headimg
 * @property string $shareimg
 * @property string $sharetitle
 * @property string $sharedesc
 */
class TPlugFudaiBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_plug_ysfudai_base';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid'], 'required'],
            [['bid'], 'integer'],
            [['name', 'telphone', 'telpeople', 'sharetitle'], 'string', 'max' => 125],
            [['headimg', 'shareimg', 'sharedesc'], 'string', 'max' => 255]
        ];
    }

    public function scenarios()
    {
        return [
            'setAdd'=>['bid','name','telphone','telpeople','sharetitle','headimg','shareimg','sharedesc'],
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
            'telphone' => 'Telphone',
            'telpeople' => 'Telpeople',
            'headimg' => 'Headimg',
            'shareimg' => 'Shareimg',
            'sharetitle' => 'Sharetitle',
            'sharedesc' => 'Sharedesc',
        ];
    }
}

<?php

namespace common\models\fudai;

use Yii;

/**
 * This is the model class for table "t_plug_fudai_user_detail".
 *
 * @property integer $id
 * @property integer $bid
 * @property integer $tpid
 * @property string $key
 * @property string $createtime
 * @property string $day
 */
class TPlugFudaiUserDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_plug_ysfudai_user_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid', 'tpid','yid'], 'required'],
            [['id', 'bid', 'tpid','yid'], 'integer'],
            [['createtime'], 'safe'],
            [['key'], 'string', 'max' => 125],
            [['day'], 'string', 'max' => 8]
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
            'tpid' => 'Tpid',
            'key' => 'Key',
            'createtime' => 'Createtime',
        ];
    }
}

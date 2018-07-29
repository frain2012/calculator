<?php

namespace common\models\fudai;

use Yii;

/**
 * This is the model class for table "t_plug_fudai_topic".
 *
 * @property string $id
 * @property integer $bid
 * @property string $name
 * @property integer $sort
 * @property integer $status
 */
class TPlugFudaiTopic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_plug_ysfudai_topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid'], 'required'],
            [['bid', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}

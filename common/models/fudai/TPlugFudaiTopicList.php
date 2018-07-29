<?php

namespace common\models\fudai;

use Yii;

/**
 * This is the model class for table "t_plug_fudai_topic_list".
 *
 * @property integer $id
 * @property integer $bid
 * @property integer $tpid
 * @property integer $sort
 */
class TPlugFudaiTopicList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_plug_ysfudai_topic_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bid', 'tpid'], 'required'],
            [['id', 'bid', 'tpid', 'sort'], 'integer']
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
            'sort' => 'Sort',
        ];
    }
}

<?php

namespace common\models\user;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_log".
 *
 * @property string $id
 * @property string $ip
 * @property string $aid
 * @property string $desc
 * @property integer $created_at
 *
 * @property User $a
 */
class UserLog extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'user_log';
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }
    
    public function rules()
    {
        return [
            [['aid', 'created_at'], 'integer'],
            [['ip'], 'string', 'max' => 15],
            [['desc'], 'string', 'max' => 100]
        ];
    }

    public function getA()
    {
        return $this->hasOne(User::className(), ['id' => 'aid']);
    }
}

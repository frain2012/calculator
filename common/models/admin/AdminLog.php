<?php

namespace common\models\admin;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "admin_log".
 *
 * @property string $id
 * @property string $ip
 * @property string $aid
 * @property integer $created_at
 *
 * @property Admin $a
 */
class AdminLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_log';
    }

    /**
     * @inheritdoc
     */
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
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'created_at'], 'integer'],
            [['ip'], 'string', 'max' => 15],
            [['desc'],'string', 'max' => 100]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getA()
    {
        return $this->hasOne(Admin::className(), ['id' => 'aid']);
    }
}

<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_domain".
 *
 * @property string $id
 * @property integer $bid
 * @property integer $type
 * @property integer $status
 * @property string $domain
 */
class TBusinessDomain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid', 'type', 'status'], 'integer'],
            [['domain'], 'string', 'max' => 125]
        ];
    }

    public function scenarios()
    {
        return [
            'setInfo'=>['bid','type','status','domain'],
            'setStatus'=>['status','domain'],
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
            'type' => 'Type',
            'status' => 'Status',
            'domain' => 'Domain',
        ];
    }
}

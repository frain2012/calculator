<?php

namespace common\models\app;

use Yii;

/**
 * This is the model class for table "app_user".
 *
 * @property string $id
 * @property string $openid
 * @property string $session_key
 * @property string $nickName
 * @property string $avatarUrl
 * @property string $gender
 * @property string $city
 * @property string $province
 * @property string $country
 * @property string $status
 */
class AppUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'string', 'max' => 32],
            [['session_key'], 'string', 'max' => 400],
            [['nickName'], 'string', 'max' => 200],
            [['avatarUrl'], 'string', 'max' => 255],
            [['gender', 'status'], 'string', 'max' => 2],
            [['city'], 'string', 'max' => 50],
            [['province', 'country'], 'string', 'max' => 100],
            [['openid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'session_key' => 'Session Key',
            'nickName' => 'Nick Name',
            'avatarUrl' => 'Avatar Url',
            'gender' => 'Gender',
            'city' => 'City',
            'province' => 'Province',
            'country' => 'Country',
            'status' => 'Status',
        ];
    }
}

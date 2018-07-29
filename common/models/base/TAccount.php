<?php

namespace common\models\base;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "t_account".
 *
 * @property string $id
 * @property string $tel
 * @property string $pwd
 * @property string $brand
 * @property string $province
 * @property string $city
 * @property string $access_token
 * @property integer $status
 * @property integer $role
 * @property integer $pid
 * @property integer $createtime
 * @property string $logo
 * @property string $company
 * @property string $code
 * @property string $kefu
 * @property string $qrcode
 */
class TAccount extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_USER = 10;
    const ROLE_ADMIN = 1;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tel', 'pwd'], 'required'],
            [['status', 'role', 'pid', 'createtime'], 'integer'],
            [['tel'], 'string', 'max' => 20],
            [['pwd', 'access_token','logo','company','code','kefu','qrcode'], 'string', 'max' => 255],
            [['brand'], 'string', 'max' => 125],
            [['province', 'city'], 'string', 'max' => 32]
        ];
    }

    public function scenarios()
    {
        return [
            'setInfo'=>['brand','company','code','logo'],
            'setBottom'=>['kefu','qrcode'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tel' => 'Tel',
            'pwd' => 'Pwd',
            'brand' => 'Brand',
            'province' => 'Province',
            'city' => 'City',
            'access_token' => 'Access Token',
            'status' => 'Status',
            'role' => 'Role',
            'pid' => 'Pid',
            'createtime' => 'Createtime',
        ];
    }

    public function login($attributes){
        $user = static::findOne(['tel' => $attributes['tel'], 'status' => self::STATUS_ACTIVE]);
        if ($user && $user->validatePassword($attributes['pwd'])) {
            return Yii::$app->user->login($user, 3600);
        }
        return false;
    }


    public function generateAuthKey()
    {
        $this->access_token = \yii::$app->security->generateRandomString();
    }

    public function validatePassword($password)
    {
        return \yii::$app->security->validatePassword($password, $this->pwd);
    }

    public function setPassword($password)
    {
        $this->pwd = \yii::$app->security->generatePasswordHash($password);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->access_token;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}

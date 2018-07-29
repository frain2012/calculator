<?php

namespace common\models\calculator;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "account".
 *
 * @property string $id
 * @property string $tel
 * @property string $pwd
 * @property string $access_token
 * @property integer $status
 * @property integer $role
 * @property integer $pid
 * @property integer $createtime
 */
class Account extends \yii\db\ActiveRecord implements IdentityInterface
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
        return 'account';
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
            [['pwd', 'access_token'], 'string', 'max' => 255]
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

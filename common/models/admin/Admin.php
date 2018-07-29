<?php
namespace common\models\admin;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class Admin extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_USER = 10;
    const ROLE_ADMIN = 1;

    
    public static function tableName()
    {
    	return 'admin';
    }
    
    public static function create($attributes)
    {
        $user = new static();
        $user->setAttributes($attributes);
        
        $user->setPassword($attributes['password']);
        $user->generateAuthKey();
        
        if ($user->save()) {
            return $user;
        } else {
            return null;
        }
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    /* public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    } */
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'role'=>self::ROLE_ADMIN,'status' => self::STATUS_ACTIVE]);
    }
    
    public static function findByUname($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return \yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = \yii::$app->security->generatePasswordHash($password);
        
    }

    public function generateAuthKey()
    {
        $this->auth_key = \yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER,self::ROLE_ADMIN]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match','pattern'=>'/^[]a-z]\w*$/i'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],

        ];
    }
}

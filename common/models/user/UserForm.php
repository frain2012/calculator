<?php
namespace common\models\user;

use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $id;
    public $username;
    public $password;
    public $rememberMe = false;
    
    public $nickname;
    
    private $_user = false;
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required','on' => 'login'],
            ['rememberMe', 'boolean','on' => 'login'],
            ['password', 'validatePassword','on' => 'login'],
            [['username','nickname','password'], 'required', 'on' => 'create'],
        ];
    }
    
    public function scenarios()
    {
        return [
            'login' => ['username', 'password'],
            'create' =>['nickname', 'username', 'password'],
        ];
    }

    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Incorrect username or password.');
            }
        }
    }
    
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 60 * 20 : 0);
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
    
    public function getUserById($id)
    {
    	if ($this->_user === false) {
    		$this->_user = User::findIdentity($id);
    	}
    	return $this->_user;
    }
    
    public function signup(){
        if ($this->validate()) {
            $user = new User();
            $user->nickname = $this->nickname;
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->cid = Yii::$app->user->identity->id;
            $user->auth_key = \yii::$app->security->generateRandomString();
            if ($user->save()){
                return true;
            }
        }
        return false;
    }
}

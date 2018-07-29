<?php
namespace common\models\admin;

use Yii;
use yii\base\Model;
use common\models\admin\Admin;

/**
 * Agent form
 */
class AdminForm extends Model
{
	public $id;
    public $username;
    public $password;
    public $rememberMe = false;
    
    public $nickname;
    
    
    private $_user = false;

    /**
     * @inheritdoc
     */
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

    /**
     * 校验密码
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', '用户名或者密码错误');
            }
        }
    }
    
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600: 0);
        } else {
            return false;
        }
    }
    
    
    public function signup(){
    	if ($this->validate()) {
    		$admin = new Admin;
    		$admin->nickname = $this->nickname;
    		$admin->username = $this->username;
    		$admin->setPassword($this->password);
    		$admin->cid = Yii::$app->user->identity->id;
    		$admin->auth_key = \yii::$app->security->generateRandomString();
    		if ($admin->save()){
    			return true;
    		}
    	}
    	return false;
    }

    
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }
    
    
    public function getUserById($id)
    {
    	if ($this->_user === false) {
    		$this->_user = Admin::findIdentity($id);
    	}
    	return $this->_user;
    }
}

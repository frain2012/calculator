<?php
namespace backend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * 后台总控制器
 */
class BackendController extends Controller
{
    public function init(){
        $this->enableCsrfValidation = false;
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
	                [
	                	'allow'   => true,
	               		'actions' => ['error'],
	                ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                    	'actions' => ['login'],
                    	'allow'   => true,
                    	'roles'   => ['?'],
                    ],
                ],
            ],
        ];
    }

}

<?php
namespace frontend\controllers;

use common\models\calculator\Config;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'login', 'main'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login', 'main'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->renderPartial('error', ['exception' => $exception]);
        }
    }

    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
}
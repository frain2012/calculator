<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/29
 * Time: 18:52
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * 测试小程序
 * @package frontend\controllers
 *
 */
class AppController extends Controller{

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->renderPartial('error', ['exception' => $exception]);
        }
    }

    public function actionIndex()
    {
        $get = Yii::$app->request->get();
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['status'=>0,'msg'=>'成功',"get"=>$get,"post"=>$post];
    }

}
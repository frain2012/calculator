<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/29
 * Time: 18:52
 */

namespace frontend\controllers;

use common\models\app\AppUser;
use common\util\WechatUtil;
use common\util\WXBizDataCrypt;
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
        Yii::$app->response->format = Response::FORMAT_JSON;
        $code = Yii::$app->request->get('code');
        if (empty($code)){
            return ['status'=>0,'msg'=>'参数为空'];
        }
        $json = WechatUtil::getAppUserInfo($code);
        if ($json){
            $model = AppUser::findOne(['openid'=>$json['openid']]);
            if($model){
                $model->session_key=$json['session_key'];
            }else{
                $model = new AppUser();
                $model->session_key=$json['session_key'];
                $model->openid=$json['openid'];
            }
            if ($model->save()){
                return ['status'=>1,'msg'=>'成功',"data"=>$json];
            }
        }
        return ['status'=>0,'msg'=>'失败'];

    }


    public function actionUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();
        if (empty($data) || empty($data['encryptedData'])){
            return ['status'=>0,'msg'=>'参数为空'];
        }
//        WXBizDataCrypt usr = new WXBizDataCrypt(\Yii::$app->params['app']['appid'],);
//        if (){
//
//        }
//        $json = WechatUtil::getAppUserInfo($code);
//        if ($json){
//            $model = AppUser::findOne(['openid'=>$json['openid']]);
//            if($model){
//                $model->session_key=$json['session_key'];
//            }else{
//
//            }
//        }

        return ['status'=>1,'msg'=>'成功'];
    }

}
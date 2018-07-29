<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\calculator\Account;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use OSS\OssClient;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $defaultAction="home";

    public function init(){
        $this->enableCsrfValidation = false;
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'home','login','captcha','findpwd','register','error','upload','editor'],
                'rules' => [
                    [
                        'actions' => ['login','captcha','register','findpwd'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['home','logout','upload','editor'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' =>  [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 50,
                'width' => 80,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    public function actionHome()
    {
        return $this->redirect("/account/home");
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if(Yii::$app->request->post()){
            if (Yii::$app->request->isAjax){
                $captcha_validate  = new \yii\captcha\CaptchaAction('captcha',Yii::$app->controller);
                $code = $captcha_validate->getVerifyCode();
                $ucode = Yii::$app->request->post("code");
                Yii::$app->response->format=Response::FORMAT_JSON;
                if($code!=$ucode){
                    return ['status'=>2,'msg'=>"验证码错误"];
                }
                $TAccount = new Account();
                if ($TAccount->login(Yii::$app->request->post())){
                    return ['status'=>0,'msg'=>"登录成功"];
                }
                return ['status'=>1,'msg'=>"登录失败"];
            }
            return ['status'=>1,'msg'=>"登录失败"];
        }
        return $this->renderPartial('login');
    }

    public function  actionRegister(){

    }

    public function  actionFindpwd(){

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(["/site/login"]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if(Yii::$app->request->post()) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format=Response::FORMAT_JSON;
                if($exception !=null){
                    return ['status'=>9,'msg'=>$exception->getMessage()];
                }else{
                    return ['status'=>9,'msg'=>"未知异常"];
                }
            }
        }
    }

    public function actionUpload(){
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstanceByName('file');
            if ($model->file && $model->validate()) {
                $imageName = time().rand(1000,9999).'.'.$model->file->extension;
                $baseurl =  Yii::getAlias("@webroot").'/uploads/';
                $imgFile = $baseurl.$imageName;
                $model->file->saveAs($imgFile);
                $accessKeyId = Yii::$app->params['aliyunOss']['accessKeyId'];
                $accessKeySecret = Yii::$app->params['aliyunOss']['accessKeySecret'];
                $endpoint = Yii::$app->params['aliyunOss']['endPoint'];
                $oss = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
                $options[OssClient::OSS_HEADERS] = array(OssClient::OSS_OBJECT_ACL => 'public-read');
                $data = $oss->uploadFile(Yii::$app->params['aliyunOss']['bucket'],date("Ymd",time()).'/'.$imageName,$imgFile,$options);
                unlink($imgFile);
                Yii::$app->response->format=Response::FORMAT_JSON;
                if ($data) {
                    return ['status'=>0,'msg'=>'上传成功','url'=>$data['info']['url']];
                }else{
                    return ['status'=>9,'msg'=>'上传失败'];
                }
            }
        }
    }

    public function actionEditor(){
        $action = Yii::$app->request->get('action','');
        switch ($action){
            case "config":
                Yii::$app->response->format=Response::FORMAT_JSON;
                $configFile  = Yii::getAlias("@webroot").'/config.json';
                $json_string = file_get_contents($configFile);
                return json_decode($json_string,true);
                break;
            case "uploadimage":
                if (Yii::$app->request->isPost) {
                    $model = new UploadForm();
                    $model->file = UploadedFile::getInstanceByName('upfile');
                    if ($model->file && $model->validate()) {
                        $imageName = time().rand(1000,9999).'.'.$model->file->extension;
                        $baseurl =  Yii::getAlias("@webroot").'/uploads/';
                        $imgFile = $baseurl.$imageName;
                        $model->file->saveAs($imgFile);
                        $accessKeyId = Yii::$app->params['aliyunOss']['accessKeyId'];
                        $accessKeySecret = Yii::$app->params['aliyunOss']['accessKeySecret'];
                        $endpoint = Yii::$app->params['aliyunOss']['endPoint'];
                        $oss = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
                        $options[OssClient::OSS_HEADERS] = array(OssClient::OSS_OBJECT_ACL => 'public-read');
                        $data = $oss->uploadFile(Yii::$app->params['aliyunOss']['bucket'],date("Ymd",time()).'/'.$imageName,$imgFile,$options);
                        unlink($imgFile);
                        Yii::$app->response->format=Response::FORMAT_JSON;
                        if ($data) {
                            return ['state'=>'SUCCESS','url'=>$data['info']['url']];
                        }else{
                            return ['state'=>'上传失败'];
                        }
                    }
                }
                break;
        }
    }
}

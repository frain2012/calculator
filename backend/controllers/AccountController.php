<?php
namespace backend\controllers;

use common\models\calculator\Account;
use common\models\calculator\Config;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use Yii;
use yii\data\Pagination;

class AccountController extends BackendController
{

    public function actionHome(){
        $this->layout="user";
        $model = Config::find();
        $pages = new Pagination(['totalCount' =>$model->count(), 'pageSize' =>10]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render("home",['model'=>$data,"paegs"=>$pages]);
    }
    public function actionSave(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id','');
            if (empty($id)){
                $model = new Config();
                $model->scenario= "setAdd";
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'新增成功'];
                }
                return ['status'=>1,'msg'=>'新增失败'];
            }else{
                $model = Config::findOne(['id'=>$id]);
                $model->scenario= "setAdd";
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'保存成功'];
                }
                return ['status'=>1,'msg'=>'保存失败'];
            }
        }
    }
    public function actionDel(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id','');
            if (!empty($id)){
                $model = Config::findOne(['id'=>$id]);
                $model->delete();
                return ['status'=>0,'msg'=>'删除成功'];
            }
            return ['status'=>1,'msg'=>'删除失败'];
        }
    }

    /*******账号列表******/

    public function actionList(){
        $this->layout="user";
        $model = Account::find()->select(['id','tel']);
        $pages = new Pagination(['totalCount' =>$model->count(), 'pageSize' =>10]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render("account",['model'=>$data,"paegs"=>$pages]);
    }


    public function actionAdd(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id','');
            if (empty($id)){
                $model = new Account();
                $tel = Yii::$app->request->post('tel','');
                $pwd = Yii::$app->request->post('pwd','');
                if (empty($tel) || empty($pwd)){
                    return ['status'=>1,'msg'=>'参数为空'];
                }
                $model->tel=$tel;
                $model->setPassword($pwd);
                $model->status=$model::STATUS_ACTIVE;
                $model->role=$model::ROLE_USER;
                $model->pid=Yii::$app->user->identity->id;
                $model->generateAuthKey();
                if($model->save()){
                    return ['status'=>0,'msg'=>'新增成功'];
                }
                return ['status'=>1,'msg'=>'新增失败'];
            }else{
                $pwd = Yii::$app->request->post('pwd','');
                if(empty($pwd)){
                    return ['status'=>1,'msg'=>'参数为空'];
                }
                $model = Account::findOne(['id'=>$id]);
                if(empty($model)){
                    return ['status'=>1,'msg'=>'未查询到'];
                }
                $model->setPassword($pwd);
                $model->generateAuthKey();
                if($model->save()){
                    return ['status'=>0,'msg'=>'保存成功'];
                }
                return ['status'=>1,'msg'=>'保存失败'];
            }
        }
    }

    public function actionAdel(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id','');
            if (!empty($id)){
                $model = Account::findOne(['id'=>$id]);
                $model->delete();
                return ['status'=>0,'msg'=>'删除成功'];
            }
            return ['status'=>1,'msg'=>'删除失败'];
        }
    }
}


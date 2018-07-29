<?php
namespace backend\controllers;


use common\models\base\TAccount;
use common\models\base\TBusinessAdmin;
use common\models\base\TBusinessDomain;
use common\models\base\TBusinessQrcode;
use common\models\base\TBusinessShare;
use common\models\base\TBusinessShop;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\data\Pagination;

class SettingController extends BackendController
{
    public $layout = "user";

    public function actionBiz(){
        if(Yii::$app->request->isPost){
            $model = TAccount::findOne(Yii::$app->request->post("id",0));
            $model->scenario= "setInfo";
            Yii::$app->response->format=Response::FORMAT_JSON;
            if($model->load(Yii::$app->request->post(),"") && $model->save()){
                return ['status'=>0,'msg'=>'保存成功'];
            }
            return ['status'=>1,'msg'=>'保存失败'];
        }

        $edit = Yii::$app->request->get("edit");
        $hbid = Yii::$app->request->get("hbid");
        if(empty($hbid)){
            $hbid = Yii::$app->user->identity->id;
        }
        $data = TAccount::findOne(['id'=>$hbid]);
        if(!is_null($edit)){
            return $this->render("biz-edit",['data'=>$data]);
        }else{
            return $this->render("biz",["data"=>$data,"hbid"=>$hbid]);
        }
    }

    /****shop门店****/

    public function actionShop(){
        $name = Yii::$app->request->get('name','');
        $hbid = Yii::$app->user->identity->id;
        $shop = TBusinessShop::find()->where(['bid'=>$hbid]);
        if(!empty($name)){
            $shop->andWhere(['like','name',$name]);
        }
        $pages = new Pagination(['totalCount' =>$shop->count(), 'pageSize' =>10]);
        $model = $shop->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render("shop",['model'=>$model,'pages'=>$pages,'name'=>$name]);
    }

    public function actionShopstatus(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id',0);
            $hbid = Yii::$app->user->identity->id;
            $status = Yii::$app->request->post('status',0);
            if(empty($id) || empty($status)){
                return ['status'=>1,'msg'=>'参数为空'];
            }
            $tag = TBusinessShop::updateAll(['status'=>$status],['bid'=>$hbid,'id'=>$id]);
            if($tag){
                return ['status'=>0,'msg'=>'设置成功'];
            }
            return ['status'=>1,'msg'=>'设置失败'];
        }
    }

    public function actionShopedit(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id',0);
            if(empty($id)){
                $model = new TBusinessShop();
                $model->scenario= "setAdd";
                $model->status=1;
                $model->bid= Yii::$app->user->identity->getId();
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'新增成功'];
                }
                return ['status'=>1,'msg'=>'新增失败'];
            }else{
                $model = TBusinessShop::findOne($id);
                $model->scenario= "setAdd";
                $model->status=1;
                $model->bid= Yii::$app->user->identity->getId();
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'保存成功'];
                }
                return ['status'=>1,'msg'=>'保存失败'];
            }
        }
        $hbid = Yii::$app->request->get('hbid',0);
        if (!empty($hbid)){
            $model = TBusinessShop::findOne($hbid);
            return $this->render("shop-edit",['data'=>$model]);
        }
        return $this->render("shop-edit",['data'=>null]);
    }

    /****admin配置***/

    public function actionAdmin(){
        $hbid = Yii::$app->user->identity->id;
        $admin = TBusinessAdmin::find()->where(['bid'=>$hbid]);
        $pages = new Pagination(['totalCount' =>$admin->count(), 'pageSize' =>10]);
        $model = $admin->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render("admin",['model'=>$model,'pages'=>$pages]);
    }

    /****公众号配置***/

    public function actionMp(){
        $hbid = Yii::$app->user->identity->id;
        $admin = TBusinessQrcode::find()->where(['bid'=>$hbid]);
        $pages = new Pagination(['totalCount' =>$admin->count(), 'pageSize' =>10]);
        $model = $admin->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render("mp",['model'=>$model,'pages'=>$pages]);
    }

    public function actionMpedit(){
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id',0);
            if(empty($id)){
                $model = new TBusinessQrcode();
                $model->scenario= "setAdd";
                $model->time = date("Y-m-d H:i:s");
                $model->bid= Yii::$app->user->identity->getId();
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'新增成功'];
                }
                return ['status'=>1,'msg'=>'新增失败'];
            }else{
                $model = TBusinessQrcode::findOne($id);
                $model->scenario= "setAdd";
                $model->bid= Yii::$app->user->identity->getId();
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'保存成功'];
                }
                return ['status'=>1,'msg'=>'保存失败'];
            }
        }
        $hbid = Yii::$app->request->get('hbid',0);
        if (!empty($hbid)){
            $model = TBusinessShop::findOne($hbid);
            return $this->render("mp-edit",['data'=>$model]);
        }
        return $this->render("mp-edit",['data'=>null]);
    }

    /****公众号配置***/

    public function actionAppmenu(){
        return $this->render("appmenu",['data'=>null]);
    }


    public function actionBottom(){
        $id = Yii::$app->user->identity->id;
        if(Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $account = TAccount::findOne($id);
            $account->scenario = "setBottom";
            if($account->load(Yii::$app->request->post(), "") && $account->save()){
                return ['status' => 0, 'msg' => '保存成功'];
            }
            return ['status' => 1, 'msg' => '保存失败'];
        }
        $account = TAccount::findOne($id);
        return $this->render("bottom",['data'=>$account]);
    }

    /****域名配置***/

    public function  actionDomain(){
        $bid = Yii::$app->user->identity->id;
        $share = TBusinessShare::findOne(['bid'=>$bid]);
        if(Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $action = Yii::$app->request->post('action');
            if(!is_null($action) && $action =="config"){
                if($share == null){
                    $share = new TBusinessShare();
                }
                $share->bid = $bid;
                $share->scenario = "setInfo";
                if($share->load(Yii::$app->request->post(), "") && $share->save()){
                    return ['status' => 0, 'msg' => '保存成功'];
                }
                return ['status' => 1, 'msg' => '保存失败'];
            }else if(!is_null($action) && $action =="save_domain"){
                $domain = new TBusinessDomain();
                $domain->scenario = "setInfo";
                $domain->bid = $bid;
                $domain->type=3;
                $domain->status=2;
                if($domain->load(Yii::$app->request->post(), "") && $domain->save()){
                    return ['status' => 0, 'msg' => '保存成功'];
                }
                return ['status' => 1, 'msg' => '保存失败'];
            }else if(!is_null($action) && $action =="set_status"){
                $id = trim(Yii::$app->request->post('id'));
                $tdomain = TBusinessDomain::findOne(['id'=>$id,'bid'=>$bid]);
                if($tdomain==null){
                    return ['status' => 1, 'msg' => '记录不存在'];
                }
                $tdomain->scenario = "setStatus";
                if($tdomain->load(Yii::$app->request->post(), "") && $tdomain->save()){
                    return ['status' => 0, 'msg' => '保存成功'];
                }
                return ['status' => 1, 'msg' => '保存失败'];
            }else{
                return ['status' => 1, 'msg' => '保存失败'];
            }
        }
        $domain = TBusinessDomain::find()->where(['bid'=>$bid])->andWhere(['>','status',-2])->all();
        return $this->render("domain",['data'=>$share,'model'=>$domain]);
    }



    public  function actionPassword(){
        $this->layout="user";
        return $this->render("passwd");
    }
}


<?php
namespace backend\controllers;

use common\models\fudai\TPlugFudaiBase;
use common\models\fudai\TPlugFudaiDetail;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use Yii;
use yii\data\Pagination;

class PlugController extends BackendController
{
    public $layout="fudai";

    public function actionYsfudai(){
        $hbid = Yii::$app->user->identity->id;
        $title = Yii::$app->request->get('title','');
        $model = TPlugFudaiDetail::find()->select(['id','name','start','end','stauts'])->where(['bid'=>$hbid]);
        if (!empty($title)){
            $model->andWhere(['like','name',$title]);;
        }
        $status = Yii::$app->request->get('status',-1);
        if ($status>-1){
            $model->andWhere(['=','stauts',$status]);
        }
        $pages = new Pagination(['totalCount' =>$model->count(), 'pageSize' =>10]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render("ysfudai",['model'=>$data,'title'=>$title,'status'=>$status]);
    }

    public function actionYsfudaiconfig(){
        $hbid = Yii::$app->user->identity->id;
        if(Yii::$app->request->isPost){
            Yii::$app->response->format=Response::FORMAT_JSON;
            $model = TPlugFudaiBase::findOne(['bid'=>$hbid]);
            if(empty($model)){
                $model = new TPlugFudaiBase();
                $model->scenario= "setAdd";
                $model->bid= $hbid;
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'新增成功'];
                }
                return ['status'=>1,'msg'=>'新增失败'];
            }else{
                $model = TPlugFudaiBase::findOne(['bid'=>$hbid]);
                $model->scenario= "setAdd";
                $model->bid= Yii::$app->user->identity->getId();
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'保存成功'];
                }
                return ['status'=>1,'msg'=>'保存失败'];
            }
        }
        $data = TPlugFudaiBase::findOne(['bid'=>$hbid]);
        return $this->render("ysfudai-set",['data'=>$data]);
    }


    public function actionYsfudaiedit(){
        $hbid = Yii::$app->user->identity->id;
        if(Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id','');
            if(empty($id)){
                $model = new TPlugFudaiDetail();
                $model->scenario="setInfo";
                $model->bid= $hbid;
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'新增成功'];
                }
                return ['status'=>1,'msg'=>'新增失败'];
            }else{
                $model = TPlugFudaiDetail::findOne(['bid'=>$hbid,'id'=>$id]);
                $model->scenario= "setInfo";
                $model->bid= $hbid;
                if($model->load(Yii::$app->request->post(),"") && $model->save()){
                    return ['status'=>0,'msg'=>'保存成功'];
                }
                return ['status'=>1,'msg'=>'保存失败'];
            }
        }
        $id = Yii::$app->request->get('id','');
        $data = TPlugFudaiDetail::findOne(['id'=>$id,'bid'=>$hbid]);
        return $this->render("ysfudai-edit",['data'=>$data]);
    }

    public function actionFudai(){
        return $this->render("fudai");
    }

    public function actionSwitch()
    {
        return $this->render("switch");
    }

    public function actionBiz(){
        $this->layout="user";
        return $this->render("biz");
    }

    public  function actionPassword(){
        $this->layout="user";
        return $this->render("passwd");
    }
}


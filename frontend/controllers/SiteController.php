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
    const Loss_Work=3500;   //误工费
    const Board_Wages=50;       //住院伙食费
    const Nutrition_Fee=30;      //营养费
    const Nursing_Fee=132.88;    //护理费



    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','login','main'],
                'rules' => [
                    [
                        'actions' => ['signup','login','main'],
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

	public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->renderPartial('error', ['exception' => $exception]);
        }
    }

    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionCalulator()
    {
        if(Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $type = Yii::$app->request->post('type',-1);
            if (empty($type) && $type<1 && $type>6){
                return ['status'=>1,'msg'=>'参数类型错误'];
            }
            //公用参数
            $day = Yii::$app->request->post('day',0);
            $money = Yii::$app->request->post('money',0);
            if (strlen($day)<1 || empty($money)){
                return ['status'=>1,'msg'=>'实际天数或者实际工资为空'];
            }
            if ($day<0 || $money<1){
                return ['status'=>1,'msg'=>'实际天数或者实际工资必须大于0'];
            }
            if($money>3500){
                $money=3500;
            }
            if ($type<5){
                $age = Yii::$app->request->post('age',-1);
                if (empty($age) || $age<0){
                    return ['status'=>1,'msg'=>'年龄不能为空'];
                }
                if ($age<=60){
                    $age=20;
                }else if($age<=75){
                    $age = 20-($age-60);
                }else{
                    $age=5;
                }

                $live = Yii::$app->request->post('live',0);
                if (empty($live) || $live<0){
                    return ['status'=>1,'msg'=>'是否住院不能为空'];
                }
                $str = "((".$day."/30)*".$money.")";
                $dmoney = ($day/30)*$money;
                if($live==1){
                    //伙食费、营养费、护理费
                    $dmoney = $dmoney+($day*60)+(132.88*$day);
                    $str.="+(".$day."*60)+(132.88*".$day.")";
                }
                //$dmoney = ($day/30)*$money+($day*80)+(132.88*$day);

                $dstr= date("Y", strtotime("-1 year"));
            }else{
                $str = "((".$day."/30)*".$money.")";
                $dmoney = ($day/30)*$money;
            }
            switch ($type){
                case 1:
                    $grade = Yii::$app->request->post('grade',0);
                    if (empty($grade) || $grade<0){
                        return ['status'=>1,'msg'=>'伤残等级不能为空'];
                    }

                    $grade = (11-$grade)/10;    //伤残等级
                    $model = Config::findOne(['year'=>$dstr]);
                    $str.="+(".$age."*".$model->town_dis_income."*".$grade.")";
                    $age = $age*$model->town_dis_income*$grade; //伤残赔偿金
                    $total = $dmoney+$age;
                    return ['status'=>0,'msg'=>'成功','data'=>$total,"str"=>$str];
                case 2:
                    $grade = Yii::$app->request->post('grade',0);
                    if (empty($grade) || $grade<0){
                        return ['status'=>1,'msg'=>'伤残等级不能为空'];
                    }
                    $grade = (11-$grade)/10;    //伤残等级
                    $model = Config::findOne(['year'=>$dstr]);
                    $str.="+(".$age."*".$model->area_dis_income."*".$grade.")";
                    $age = $age*$model->area_dis_income*$grade; //伤残赔偿金
                    $total = $dmoney+$age;
                    return ['status'=>0,'msg'=>'成功','data'=>$total,"str"=>$str];
                case 3:
                    $scale = Yii::$app->request->post('scale',0);   //责任比例
                    if(empty($scale) || $scale<0){
                        return ['status'=>1,'msg'=>'责任比例不能为空'];
                    }


                    $grade = Yii::$app->request->post('grade',0);   //1-父母，2-子女
                    $year = Yii::$app->request->post('year',0);
                    if (!empty($grade)){
                        if (empty($year)){
                            return ['status'=>1,'msg'=>'被抚养年龄不能为空'];
                        }
                    }

                    $model = Config::findOne(['year'=>$dstr]);
                    $str.="+(".$age."*".$model->town_dis_income.")";
                    $age = $age*$model->town_dis_income; //死亡赔偿金
                    $age = $age+($model->avg_wage/2);     //丧葬费
                    $str.="+(".$model->avg_wage."/2)";
                    $age = $age+(500*$scale);     //责任比例
                    $str.="+(500*".$scale.")";
                    if (!empty($grade)){
                        if($grade==1){
                            if ($year<=18){
                                $year=18;
                            }else{
                                $year=0;
                            }
                        }else{
                            if ($year<=60){
                                $year=20;
                            }else if($year<=75){
                                $year = 20-($year-60);

                            }else{
                                $year=5;
                            }
                        }

                        $age = $age+(($model->town_con_income*$year)*2);
                        $str.="+((".$model->town_con_income."*".$year.")*2)";
                    }
                    $total = $age+$dmoney;
                    return ['status'=>0,'msg'=>'成功','data'=>$total,'str'=>$str];
                case 4:
                    $scale = Yii::$app->request->post('scale',0);   //责任比例
                    if(empty($scale) || $scale<0){
                        return ['status'=>1,'msg'=>'责任比例不能为空'];
                    }

                    $grade = Yii::$app->request->post('grade',0);   //1-父母，2-子女
                    $year = Yii::$app->request->post('year',0);
                    if (!empty($grade)){
                        if (empty($year)){
                            return ['status'=>1,'msg'=>'被抚养年龄不能为空'];
                        }
                    }

                    $model = Config::findOne(['year'=>$dstr]);
                    $str.="+(".$model->area_dis_income."*".$age.")";
                    $age = $age*$model->area_dis_income; //死亡赔偿金
                    $age = $age+($model->avg_wage/2);     //丧葬费
                    $str.="+(".$model->avg_wage."/2)";
                    $age = $age+(500*$scale);     //责任比例
                    $str.="+(500*".$scale.")";
                    if (!empty($grade)){
                        if($grade==1){
                            if ($year<=18){
                                $year=18;
                            }else{
                                $year=0;
                            }
                        }else{
                            if ($year<=60){
                                $year=20;
                            }else if($year<=75){
                                $year = 20-($year-60);

                            }else{
                                $year=5;
                            }
                        }
                        $age = $age+(($model->area_con_income*$year)*2);
                        $str.="+((".$model->area_con_income."*".$year.")*2)";
                    }
                    $total = $age+$dmoney;
                    return ['status'=>0,'msg'=>'成功','data'=>$total,'str'=>$str];
                case 5:
                    $total = $dmoney;
                    return ['status'=>0,'msg'=>'成功','data'=>$total,'str'=>$str];
                case 6:
                    $dmoney = $dmoney+($day*60)+(132.88*$day);
                    $total = $dmoney;
                    $str.="+(".$day."*60)+(132.88*".$day.")";
                    return ['status'=>0,'msg'=>'成功','data'=>$total,'str'=>$str];
            }
        }
    }
}

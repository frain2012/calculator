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
    const Loss_Work = 3500;   //误工费
    const Board_Wages = 50;       //住院伙食费
    const Nutrition_Fee = 30;      //营养费
    const Nursing_Fee = 132.88;    //护理费


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

    public function actionCalulator()
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $type = Yii::$app->request->post('type', -1);
            if (empty($type) && $type < 1 && $type > 6) {
                return ['status' => 1, 'msg' => '参数类型错误'];
            }
            //公用参数
            $day = Yii::$app->request->post('day', 0);
            $money = Yii::$app->request->post('money', 0);
            if (strlen($day) < 1 || empty($money)) {
                return ['status' => 1, 'msg' => '实际天数或者实际工资为空'];
            }
            if ($day < 0 || $money < 1) {
                return ['status' => 1, 'msg' => '实际天数或者实际工资必须大于0'];
            }
            if ($money > 3500) {
                $money = 3500;
            }
            if ($type < 5) {
                $age = Yii::$app->request->post('age', -1);
                if (empty($age) || $age < 0) {
                    return ['status' => 1, 'msg' => '年龄不能为空'];
                }
                if ($age <= 60) {
                    $age = 20;
                } else if ($age <= 75) {
                    $age = 20 - ($age - 60);
                } else {
                    $age = 5;
                }

                $live = Yii::$app->request->post('live', 0);
                if (empty($live) || $live < 0) {
                    return ['status' => 1, 'msg' => '是否住院不能为空'];
                }
                $str = "((" . $day . "/30)*" . $money . ")";
                $dmoney = ($day / 30) * $money;
                if ($live == 1) {
                    //伙食费、营养费、护理费
                    $dmoney = $dmoney + ($day * 60) + (132.88 * $day);
                    $str .= "+(" . $day . "*60)+(132.88*" . $day . ")";
                }
                //$dmoney = ($day/30)*$money+($day*80)+(132.88*$day);

                $dstr = date("Y", strtotime("-1 year"));
            } else {
                $str = "((" . $day . "/30)*" . $money . ")";
                $dmoney = ($day / 30) * $money;
            }
            switch ($type) {
                case 1:
                    $grade = Yii::$app->request->post('grade', 0);
                    if (empty($grade) || $grade < 0) {
                        return ['status' => 1, 'msg' => '伤残等级不能为空'];
                    }

                    $grade = (11 - $grade) / 10;    //伤残等级
                    $model = Config::findOne(['year' => $dstr]);
                    $str .= "+(" . $age . "*" . $model->town_dis_income . "*" . $grade . ")";
                    $age = $age * $model->town_dis_income * $grade; //伤残赔偿金
                    $total = $dmoney + $age;
                    return ['status' => 0, 'msg' => '成功', 'data' => $total, "str" => $str];
                case 2:
                    $grade = Yii::$app->request->post('grade', 0);
                    if (empty($grade) || $grade < 0) {
                        return ['status' => 1, 'msg' => '伤残等级不能为空'];
                    }
                    $grade = (11 - $grade) / 10;    //伤残等级
                    $model = Config::findOne(['year' => $dstr]);
                    $str .= "+(" . $age . "*" . $model->area_dis_income . "*" . $grade . ")";
                    $age = $age * $model->area_dis_income * $grade; //伤残赔偿金
                    $total = $dmoney + $age;
                    return ['status' => 0, 'msg' => '成功', 'data' => $total, "str" => $str];
                case 3:
                    $scale = Yii::$app->request->post('scale', 0);   //责任比例
                    if (empty($scale) || $scale < 0) {
                        return ['status' => 1, 'msg' => '责任比例不能为空'];
                    }


                    $grade = Yii::$app->request->post('grade', 0);   //1-无，2-有
                    $year1 = array_filter(Yii::$app->request->post('year1', 0));     //被抚养年龄(子女)
                    $year2 = array_filter(Yii::$app->request->post('year2', 0));     //被抚养年龄(父母)
                    $raise = Yii::$app->request->post('raise', 0);   //均摊人数
                    if (!empty($grade)) {
                        if (sizeof($year1) < 1 && sizeof($year2) < 1) {
                            return ['status' => 1, 'msg' => '被抚养年龄不能全为空'];
                        }
                        if (empty($raise)) {
                            return ['status' => 1, 'msg' => '均摊人数不能为空'];
                        }
                    }

                    $model = Config::findOne(['year' => $dstr]);
                    $str .= "+(" . $age . "*" . $model->town_dis_income . ")";
                    $age = $age * $model->town_dis_income; //死亡赔偿金
                    $age = $age + ($model->avg_wage / 2);     //丧葬费
                    $str .= "+(" . $model->avg_wage . "/2)";
                    $age = $age + (500 * $scale);     //责任比例
                    $str .= "+(500*" . $scale . ")";
                    if (!empty($grade)) {
                        $t_year1=$this->transAge($year1, true);
                        $t_year2=$this->transAge($year2, false);
                        $group1 = $this->groupAge($t_year1);
                        $group2 = $this->groupAge($t_year2);
                        $AllAge = $this->diffComAge($group1, $group2);    //被抚养所有年龄
                        $size = count($AllAge);
                        $totalRaise=0;
                        for($j=0;$j<$size;$j++){
                            $totalRaise+=$this->calNum($AllAge,$model->town_con_income,$raise,$j,$str);
                        }
                        $age = $age+$totalRaise;
                    }
                    $total = $age + $dmoney;
                    return ['status' => 0, 'msg' => '成功', 'data' => $total, 'str' => $str];
                case 4:
                    $scale = Yii::$app->request->post('scale', 0);   //责任比例
                    if (empty($scale) || $scale < 0) {
                        return ['status' => 1, 'msg' => '责任比例不能为空'];
                    }

                    $grade = Yii::$app->request->post('grade', 0);   //1-无，2-有
                    $year1 = array_filter(Yii::$app->request->post('year1', 0));     //被抚养年龄(子女)
                    $year2 = array_filter(Yii::$app->request->post('year2', 0));     //被抚养年龄(父母)
                    $raise = Yii::$app->request->post('raise', 0);   //均摊人数
                    if (!empty($grade)) {
                        if (sizeof($year1) < 1 && sizeof($year2) < 1) {
                            return ['status' => 1, 'msg' => '被抚养年龄不能全为空'];
                        }
                        if (empty($raise)) {
                            return ['status' => 1, 'msg' => '均摊人数不能为空'];
                        }
                    }

                    $model = Config::findOne(['year' => $dstr]);
                    $str .= "+(" . $model->area_dis_income . "*" . $age . ")";
                    $age = $age * $model->area_dis_income; //死亡赔偿金
                    $age = $age + ($model->avg_wage / 2);     //丧葬费
                    $str .= "+(" . $model->avg_wage . "/2)";
                    $age = $age + (500 * $scale);     //责任比例
                    $str .= "+(500*" . $scale . ")";
                    if (!empty($grade)) {
                        $t_year1=$this->transAge($year1, true);
                        $t_year2=$this->transAge($year2, false);
                        $group1 = $this->groupAge($t_year1);
                        $group2 = $this->groupAge($t_year2);
                        $AllAge = $this->diffComAge($group1, $group2);    //被抚养所有年龄
                        $size = count($AllAge);
                        $totalRaise=0;
                        for($j=0;$j<$size;$j++){
                            $totalRaise+=$this->calNum($AllAge,$model->area_con_income,$raise,$j,$str);
                        }
                        $age = $age+$totalRaise;
                    }
                    $total = $age + $dmoney;
                    return ['status' => 0, 'msg' => '成功', 'data' => $total, 'str' => $str];
                case 5:
                    $total = $dmoney;
                    return ['status' => 0, 'msg' => '成功', 'data' => $total, 'str' => $str];
                case 6:
                    $dmoney = $dmoney + ($day * 60) + (132.88 * $day);
                    $total = $dmoney;
                    $str .= "+(" . $day . "*60)+(132.88*" . $day . ")";
                    return ['status' => 0, 'msg' => '成功', 'data' => $total, 'str' => $str];
            }
        }
    }


    /**
     * 年龄转换
     * @param $arry1
     * @param $arry2
     */
    private function transAge($arry1, $isMin = true)
    {
        $arry = array();
        if ($isMin) {
            foreach ($arry1 as $value) {
                if ($value <= 18) {
                    $arry[] = 18 - $value;
                } else {
                    $arry[] = 0;
                }
            }
        } else {
            foreach ($arry1 as &$value) {
                if ($value <= 60) {
                    $arry[] = 20;
                } else if ($value <= 75) {
                    $arry[] = 20 - ($value - 60);

                } else {
                    $arry[] = 5;
                }
            }
        }
        return $arry;
    }

    /**
     * 合并相同的组
     * @param $arry1
     */
    private function groupAge($arry1)
    {
        $arry_2 = array();
        sort($arry1);
        $last = null;
        foreach ($arry1 as $value) {
            if (is_null($last) || $value != $last) {
                $last = $value;
                $arry_2[$value] = 1;
            } else {
                $arry_2[$value] = $arry_2[$value] + 1;
            }
        }
        return $arry_2;
    }

    /**
     * 合并所有
     * @param $group1
     * @param $group2
     * @return array
     */
    private function diffComAge($group1, $group2)
    {
        $last = null;
        $arry_1 = array();
        foreach ($group1 as $k => $v) {
            if (is_null($last)) {
                $last = $k;
                $arry_1[] = array("k" => $k, "v" => $v, "t" => 1);
            } else {
                $key = $k - $last;
                $arry_1[] = array("k" => $key, "v" => $v, "t" => 1);
                $last = $k;
            }
        }
        foreach ($group2 as $k => $v) {
            if (is_null($last)) {
                $last = $k;
                $arry_1[] = array("k" => $k, "v" => $v, "t" => 2);
            } else {
                $key = $k - $last;
                $arry_1[] = array("k" => $key, "v" => $v, "t" => 2);
                $last = $k;
            }
        }
        return $arry_1;
    }


    private function calNum($array,$amount,$raise=1,$num=0,&$str){
        $size = count($array);
        $p = 0;
        for ($j=$num;$j<$size;$j++){
            $t = $array[$j];
            if ($t['t']==1){
                $p=$p+($t['v']/2);
            }else{
                $p=$p+($t['v']/$raise);
            }
        }
        $year = $array[$num]['k'];
        $p = $p>1?1:$p;
        $str.="+(".$amount."*".$year."*".$p.')';
        return $amount*$p*$year;

    }
}
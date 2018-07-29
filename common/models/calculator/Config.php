<?php

namespace common\models\calculator;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $year
 * @property double $town_dis_income
 * @property double $town_con_income
 * @property double $area_dis_income
 * @property double $area_con_income
 * @property double $avg_wage
 * @property string $eff_date
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','town_dis_income', 'town_con_income', 'area_dis_income', 'area_con_income', 'avg_wage'], 'number'],
            [['eff_date'], 'safe'],
            [['year'], 'string', 'max' => 10]
        ];
    }

    public function scenarios()
    {
        return [
            'setAdd'=>['id','town_dis_income', 'town_con_income', 'area_dis_income', 'area_con_income', 'avg_wage', 'eff_date', 'year'],
        ];
    }


}

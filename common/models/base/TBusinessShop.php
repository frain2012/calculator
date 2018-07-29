<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_business_shop".
 *
 * @property string $id
 * @property integer $bid
 * @property string $name
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $tel
 * @property string $logo
 * @property string $kefu
 * @property string $content
 * @property integer $status
 * @property string $addr
 * @property string $imgs
 * @property integer $is_passwd
 * @property string $passwd
 */
class TBusinessShop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_business_shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid'], 'required'],
            [['bid', 'status','is_passwd'], 'integer'],
            [['name', 'tel', 'logo', 'kefu', 'addr','imgs','passwd'], 'string', 'max' => 255],
            [['province', 'city', 'area'], 'string', 'max' => 125],
            [['content'], 'string', 'max' => 2000]
        ];
    }

    public function scenarios()
    {
        return [
            'setAdd'=>['bid','name','tel','logo','kefu','content','status','addr','imgs','is_passwd','passwd'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bid' => 'Bid',
            'name' => 'Name',
            'province' => 'Province',
            'city' => 'City',
            'area' => 'Area',
            'tel' => 'Tel',
            'logo' => 'Logo',
            'kefu' => 'Kefu',
            'content' => 'Content',
            'status' => 'Status',
            'add' => 'Add',
        ];
    }
}

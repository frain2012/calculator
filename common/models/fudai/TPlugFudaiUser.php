<?php

namespace common\models\fudai;

use Yii;

/**
 * This is the model class for table "t_plug_fudai_user".
 *
 * @property integer $id
 * @property integer $bid
 * @property integer $yid
 * @property string $openid
 * @property string $nickname
 * @property string $sex
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $headimgurl
 * @property integer $num
 * @property string $realname
 * @property string $realtel
 * @property string $realadd
 * @property integer $status
 * @property string $createtime
 * @property string $day
 * @property string $finishtime
 *
 *
 */
class TPlugFudaiUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_plug_ysfudai_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'bid', 'openid','yid'], 'required'],
            [['id', 'bid', 'num', 'status','yid'], 'integer'],
            [['createtime','finishtime'], 'safe'],
            [['openid'], 'string', 'max' => 32],
            [['day'], 'string', 'max' => 8],
            [['nickname', 'province', 'city', 'country', 'headimgurl', 'realname', 'realadd'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 10],
            [['realtel'], 'string', 'max' => 125]
        ];
    }

    public function scenarios()
    {
        return [
            'addr'=>['realname','realadd','realtel','bid','id','status'],
            'add'=>['bid','yid','openid','nickname','headimgurl','createtime','num','day','status'],
        ];
    }
}

<?php

namespace common\models\fudai;

use Yii;

/**
 * This is the model class for table "t_ysfudai_user".
 *
 * @property string $openid
 * @property string $nickname
 * @property string $sex
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $headimgurl
 */
class TYsfudaiUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ysfudai_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['openid'], 'string', 'max' => 28],
            [['nickname', 'province', 'city', 'country', 'headimgurl'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 5]
        ];
    }
}

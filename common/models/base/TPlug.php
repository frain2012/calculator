<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "t_plug".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $desc
 * @property string $url
 */
class TPlug extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_plug';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'type'], 'integer'],
            [['name'], 'string', 'max' => 125],
            [['desc', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'desc' => 'Desc',
            'url' => 'Url',
        ];
    }
}

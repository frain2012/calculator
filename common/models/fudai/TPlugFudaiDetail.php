<?php

namespace common\models\fudai;

use Yii;

/**
 * This is the model class for table "t_plug_fudai_detail".
 *
 * @property integer $id
 * @property integer $bid
 * @property string $name
 * @property string $start
 * @property string $end
 * @property integer $stauts
 * @property string $headimg
 * @property integer $showdata
 * @property integer $showrule
 * @property string $content
 * @property string $awardname
 * @property integer $awardnum
 * @property integer $focusnum
 * @property string $awardprize
 * @property integer $awardtype
 * @property integer $awardcode
 * @property string $awardshop
 * @property string $awardtips
 * @property integer $fudaitype
 * @property string $key1
 * @property string $key2
 * @property string $key3
 * @property string $key4
 * @property string $key5
 * @property string $key6
 * @property string $key7
 * @property string $key8
 * @property integer $daynum
 * @property integer $sharenum
 * @property integer $focustype
 * @property string $focusacct
 * @property integer $sendnum
 * @property string $sharetitle
 * @property string $sharedesc
 * @property string $shareimg
 */
class TPlugFudaiDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_plug_ysfudai_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'bid'], 'required'],
            [['bid', 'stauts', 'showdata', 'showrule', 'awardnum', 'awardtype', 'awardcode', 'fudaitype', 'daynum', 'sharenum', 'focustype', 'sendnum','focusnum'], 'integer'],
            [['start', 'end'], 'safe'],
            [['content'], 'string'],
            [['name', 'headimg', 'awardname', 'awardshop', 'focusacct', 'sharedesc', 'shareimg'], 'string', 'max' => 255],
            [['awardprize'], 'string', 'max' => 10],
            [['awardtips'], 'string', 'max' => 512],
            [['key1', 'key2', 'key3', 'key4', 'key5', 'key6', 'key7', 'key8'], 'string', 'max' => 32],
            [['sharetitle'], 'string', 'max' => 125]
        ];
    }

    public function scenarios()
    {
        return [
            'setInfo'=>['bid', 'stauts', 'showdata', 'showrule', 'awardnum', 'awardtype', 'awardcode', 'fudaitype', 'daynum', 'sharenum', 'focustype', 'sendnum','focusnum','start', 'end','name', 'headimg', 'awardname', 'awardshop', 'focusacct', 'sharedesc', 'shareimg','awardprize','awardtips','key1', 'key2', 'key3', 'key4', 'key5', 'key6', 'key7', 'key8','sharetitle','content'],
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
            'start' => 'Start',
            'end' => 'End',
            'stauts' => 'Stauts',
            'headimg' => 'Headimg',
            'showdata' => 'Showdata',
            'showrule' => 'Showrule',
            'content' => 'Content',
            'awardname' => 'Awardname',
            'awardnum' => 'Awardnum',
            'awardprize' => 'Awardprize',
            'awardtype' => 'Awardtype',
            'awardcode' => 'Awardcode',
            'awardshop' => 'Awardshop',
            'awardtips' => 'Awardtips',
            'fudaitype' => 'Fudaitype',
            'key1' => 'Key1',
            'key2' => 'Key2',
            'key3' => 'Key3',
            'key4' => 'Key4',
            'key5' => 'Key5',
            'key6' => 'Key6',
            'key7' => 'Key7',
            'key8' => 'Key8',
            'daynum' => 'Daynum',
            'sharenum' => 'Sharenum',
            'focustype' => 'Focustype',
            'focusacct' => 'Focusacct',
            'sendnum' => 'Sendnum',
            'sharetitle' => 'Sharetitle',
            'sharedesc' => 'Sharedesc',
            'shareimg' => 'Shareimg',
        ];
    }
}

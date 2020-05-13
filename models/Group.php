<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "groups".
 *
 * @property string $num
 */
class Group extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num'], 'required'],
            [['num'], 'string', 'max' => 30],
            [['num'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'num' => 'Num',
        ];
    }
    public function getStudent()
    {
        return $this->hasMany(student::className(), ['groups' => 'num']);
    }
    public function getGroup()
    {
        return $this->hasMany(GroupsInLesson::className(), ['groups' => 'num']);
    }
    public function fields()
    {
        return ['num','student'];
    }
}

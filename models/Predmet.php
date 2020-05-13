<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "predmeti".
 *
 * @property string $name
 */
class Predmet extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'predmet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'name',
        ];
    }
    public function getLesson()
    {
        return $this->hasMany(Lesson::className(), ['predmet' => 'name']);
    }
    public function fields()
    {
        return [
            'name'
        ];
    }
  
}

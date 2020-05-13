<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property int $id
 * @property string|null $data
 * @property string|null $predmet
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'predmet'], 'required'],
            [['data'], 'safe'],
            [['predmet'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'predmet' => 'Predmet',
        ];
    }
    
    public function getGroups()
    {
        return $this->hasMany(GroupsInLesson::className(), ['id_lesson' => 'id']);
    }
    public function getVisit()
    {
        return $this->hasMany(Visit::className(), ['les_id' => 'id']);
    }
    public function getPredmets()
    {
        return $this->hasOne(Predmet::className(), ['name' => 'predmet']);
    }
    public function fields()
    {
        return ['data','predmet','visit'];
    }
}

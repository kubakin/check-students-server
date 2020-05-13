<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groupsInLesson".
 *
 * @property int $id
 * @property int|null $id_lesson
 * @property string|null $groups
 */
class GroupsInLesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groupsInLesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lesson'], 'integer'],
            [['groups','predmet'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lesson' => 'Id Lesson',
            'groups' => 'Groups',
        ];
    }
    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'id_lesson']);
    }
    public function getGroupes()
    {
        return $this->hasOne(Group::className(), ['num' => 'groups']);
    }
    public function getVisit()
    {
        return $this->hasMany(Visit::className(), ['les_id' => 'id']);
    }
    public function getStudent(){
        return $this->hasMany(student::className(), ['groups' => 'groups']);
    }
    public function fields() {
        return ['lesson','groups'];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property int|null $les_id
 * @property int|null $stud_id
 * @property string|null $visit
 * @property string|null $itog
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['les_id'], 'integer'],
            [['itog','stud_id'], 'string'],
            [['visit'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'les_id' => 'Les ID',
            'stud_id' => 'Stud ID',
            'visit' => 'Visit',
            'itog' => 'Itog',
        ];
    }
    public function getGroups()
    {
        return $this->hasOne(GroupsInLesson::className(), ['id' => 'les_id']);
    }
    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'les_id']);
    }
    public function getStudent()
    {
        return $this->hasOne(student::className(), ['id' => 'stud_id']);
    }
    public function fields() {
        return ['visit','itog','stud_id'];
    }
}

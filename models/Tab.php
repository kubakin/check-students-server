<?php

namespace app\models;

use app\models\student;
use Yii;

/**
 * This is the model class for table "Tab".
 *
 * @property string $data
 * @property string $predmet
 * @property string $itog
 * @property string $uids_tab
 */
class Tab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tab';
    }

    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            [['data', 'predmet', 'itog', 'uids_tab','number'], 'required'],
            [['data'], 'safe'],
            [['itog'], 'string'],
            [['predmet', 'uids_tab', 'number'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'data' => 'Data',
            'predmet' => 'Predmet',
            'itog' => 'Itog',
            'uids_tab' => 'Uids Tab',
        ];
    }
    
    public function getStudent()
    {
        return $this->hasOne(student::className(), ['id' => 'uids_tab']);
    }
   
    public function fields()
    {
       return ['student','data'];
    }
    
}

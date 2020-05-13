<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "students1".
 *
 * @property string $id
 * @property string $name
 * @property string $groups
 */
class student extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'groups'], 'required'],
            [['id', 'groups'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'groups' => 'Groups',
        ];
    }
    public function getGroups()
    {
        return $this->hasOne(Group::className(), ['num' => 'groups']);
    }
    public function getVisit()
    {
        return $this->hasMany(Visit::className(), ['stud_id' => 'id']);
    }
public function fields()
{
    return [
        'id',
        'name',
        'groups',
        
        
    ];
}
public static function findByUsername($id)
    {
       
        return student::findOne($id);
         
    }
    public static function findIdentity($id)
    {
        return student::findOne($id);
    }
    public function validatePassword($password)
    {
        return $password == 'Mei8po4s';
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
   //     return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }
    
    
    public function getAuthKey()
    {
      //  return $this->login;
    }

    public function validateAuthKey($authKey)
    {
      //  return $this->authKey === $authKey;
    }

}

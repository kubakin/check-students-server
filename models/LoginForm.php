<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\ErrorException;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
 
            
          //  ldap_start_tls($ldapconn);
         
          
             
            try {
                $user = $this->getStudent()->ldapcon;
            $ldapconn = ldap_connect("ldaps://ldap.cs.prv") or die("Не могу соединиться с сервером LDAP.");
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
                $ldapbinda = ldap_bind($ldapconn, $user, $this->password);
            }
            catch (ErrorException $e) {
                $this->addError($attribute, 'Incorrect username or password.');
            

        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            //die(var_dump($this->getStudent()));
            return Yii::$app->user->login($this->getStudent(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getStudent()
    {
        if ($this->_user === false) {
            $this->_user = student::findByUsername($this->username);
        }

        return $this->_user;
    }
}

<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\Linkable;
use yii\helpers\Url;

class UserController extends ActiveController implements Linkable
{
    public $modelClass = 'app\models\User';
    public function getLinks()
    {
        return [
            'test' => Url::to(['student/view', 'uid'=>$this->uid],true)
        ];
    }
}
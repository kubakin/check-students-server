<?php

namespace app\controllers;
use yii\filters\auth\HttpBasicAuth;

use app\models\GroupsInLesson;
use app\models\Lesson;
use app\models\Pos;
use app\models\Predmet;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\student;
use app\models\Visit;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class GroupslessonController extends ActiveController
{
    public $modelClass = 'app\models\GroupsInLesson';
    public function checkAccess($action, $modeld = null, $params = [])
    {
        return true;
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
       
        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);
        
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        
        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];
        $behaviors['response'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
            'languages' => [
                'en-US',
                'de',
            ],
        ];
        return $behaviors;
    }
    

}
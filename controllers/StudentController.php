<?php

namespace app\controllers;
use yii\filters\auth\HttpBasicAuth;

use app\models\Pos;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\student;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class StudentController extends ActiveController
{
    public $modelClass = 'app\models\student';
    //$modelClass = 'app\models\Pos';
    public function checkAccess($action, $modeld = null, $params = [])
    {
        return true;
    }
    //Заменить
    public function actionAdd () {
        $postAddStudent = Yii::$app->request->post();
         $name = $postAddStudent['name'];
         $groups = $postAddStudent['groups'];
         $id = $postAddStudent['id'];
        Yii::$app->db->createCommand()->batchInsert('students1', ['id', 'name','groups'], [
            ["$id", "$name","$groups"]
        ])->execute();
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




        
        // get the posts in the current page
        public function actions()
        {
            $actions = ArrayHelper::merge(
                parent::actions(),
                [
                    'index' => [
                        'prepareDataProvider' => function ($action) {
                            /* @var $modelClass \yii\db\BaseActiveRecord */
                            $modelClass = $action->modelClass;
    
                            return Yii::createObject([
                                'class' => ActiveDataProvider::className(),
                                'query' => $modelClass::find(),
                                'pagination' => [
                                    'pageSize' => 0,
                                ],
                            ]);
                        },
                    ],
                ]
            );
    
            return $actions;
        }
        public function actionView($uid) {
            return new ActiveDataProvider([
                'query' => student::find($uid),
            ]);
         
             }
    public function actionUids() {
        return ArrayHelper::map(Student::findBySql('SELECT students1.name, students1.id  from students1')->all(),'name','id');

    }

}
<?php

namespace app\controllers;

use app\models\Group as ModelsGroup;
use app\models\Pos;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\student;
use Codeception\Lib\Generator\Group;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class GroupController extends ActiveController
{
    public $modelClass = 'app\models\Group';
    public function checkAccess($action, $modeld = null, $params = [])
    {
        return true;
    }
    public function behaviors()
    {
    return [
        [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
            'languages' => [
                'en-US',
                'de',
            ],
        ],
    ];
    
}

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
    $actions = parent::actions();
    
    unset($actions['index']);


    return $actions;
}
    public function actionIndex() {
        $groups = '';
        //$test= new ModelsGroup();
        //$test=Group::findall();
      //  $modelClass=$this->modelClass;
        // add conditions that should always apply here
     //  return var_dump(ModelsGroup::find());
     //http://localhost/basic/web/group?list=num=22305||num=22304
      // die(var_dump(Yii::$app->request->queryParams['list']));
       if(isset(Yii::$app->request->queryParams['list'])){
           $groups = Yii::$app->request->queryParams['list'];
           //die(var_dump($groups[1]));
       }
       $model = ModelsGroup::find()->where((['num' => $groups]));
       
       return new ActiveDataProvider([
        'query' => $model,
    ]);
 
    }
}
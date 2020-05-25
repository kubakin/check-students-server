<?php

namespace app\controllers;
use yii\filters\auth\HttpBasicAuth;

use app\models\GroupsInLesson;
use app\models\Lesson;
use app\models\Predmet;

use app\models\Pos;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\models\student;
use app\models\Visit;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class LessonController extends ActiveController
{
    public $modelClass = 'app\models\Lesson';
    public function checkAccess($action, $modeld = null, $params = [])
    {
        return true;
    }
    public function actionSetpos()
{
    
    return $this->render('setpos');
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
public function actions() {

    $actions = parent::actions();
    
    unset($actions['create']);


    return $actions;
}
public function actionLastid() {
   
    $idlesson= Lesson::find()
->orderBy(['id' => SORT_DESC])
->all();
    return $idlesson[0];
}

    public function actionCreate() {
        $model = new Lesson();
        $post = Yii::$app->request->post();
       // return var_dump($post);
        $test = json_decode(array_keys($post)[0]);
       
        $post['predmet'] = $test->predmet;
       // return $post['predmet'];
        $post['data'] = $test->data;
        
        $post['groups'] =$test->groups;
        if(!Predmet::findOne($post['predmet'])) {
          $pred = new Predmet();
          $pred['name'] = $post['predmet'];
          $pred->save();
      }
      
        $model->load($post,'');
        $model->save();
       $idlesson=Yii::$app->db->getLastInsertID();
        $groups = explode('_',$post['groups']);
       // die(var_dump($groups));
        foreach($groups as $i) {
            $model2 = new GroupsInLesson();
            $model2->load($post, '');
            $model2['groups'] = $i;
            $model2['id_lesson']=$idlesson;
            $model2->save();
        }
        return $idlesson;
        $gr = str_replace(' ',"&list[]=", $post['groups']);
       // die($gr);
        return $this->render('setpos',['model'=> $idlesson,'model1'=>Yii::getAlias('@web'),'gr'=>$gr,'predmet'=>$post['groups']]);
    }
    
}
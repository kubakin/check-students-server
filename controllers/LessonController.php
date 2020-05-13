<?php

namespace app\controllers;

use app\models\GroupsInLesson;
use app\models\Lesson;
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
public function actions() {

    $actions = parent::actions();
    
    unset($actions['create']);


    return $actions;
}

    public function actionCreate() {
      //  die('test');
        $model2 = new GroupsInLesson();
        $model = new Lesson();
        $post = Yii::$app->request->post();
        $model->load($post,'');
        $model->save();
       $idlesson=Yii::$app->db->getLastInsertID();
        $groups = explode(' ',$post['groups']);
       // die(var_dump($groups));
        foreach($groups as $i) {
            $model2 = new GroupsInLesson();
            $model2->load($post, '');
            $model2['groups'] = $i;
            $model2['id_lesson']=$idlesson;
            $model2->save();
        }
        //return $this->render('/site/index',['test'=> $idlesson]);
        
      //  die(var_dump($model->save()));
        
       // die(var_dump(Yii::$app->db->getLastInsertID()));
        
        //return $this->redirect(Yii::getAlias('@web').'site/index');
    }
    
}
<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\GroupsInLesson;
use app\models\Lesson;
use app\models\Predmet;

use app\models\Visit;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       // die(var_dump(Yii::$app->request->post()));
        return $this->render('index',['model'=>Yii::getAlias('@web')]);
    }
    public function actionLesson()
    {
        
        return $this->render('lesson',['model'=>Yii::getAlias('@web')]);
    }
    public function actionSetgroup()
    {
        
        return $this->render('setgroup',['model'=>Yii::getAlias('@web')]);
    }
    public function actionSetpos()
    {
        
        return $this->render('setpos',['model'=>Yii::getAlias('@web')]);
    }
   
    public function actionCreate() {
        //  die('test');
         // $model2 = new GroupsInLesson();
          $model = new Lesson();
          
          $post = Yii::$app->request->post();
          if(!Predmet::findOne($post['predmet'])) {
            $pred = new Predmet();
            $pred['name'] = $post['predmet'];
            $pred->save();
        }
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
          $gr = str_replace(' ',"&list[]=", $post['groups']);
         // die($gr);
          return $this->render('setpos',['model'=> $idlesson,'model1'=>Yii::getAlias('@web'),'gr'=>$gr,'predmet'=>$post['groups']]);
          
        //  die(var_dump($model->save()));
          
         // die(var_dump(Yii::$app->db->getLastInsertID()));
          
          //return $this->redirect(Yii::getAlias('@web').'site/index');
      }
     
    
    public function actionTest($id,$predmet)
    {
        Yii::getAlias('@webroot');
     //   die('hi');
        return $this->render('test',
    ['predmet' => $id,
    'group'=>$predmet,
    'alias'=>Yii::getAlias('@webroot'),
    'model'=>Yii::getAlias('@web')
    ]);
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        }else{
            return $this->redirect(['/site/login']);
        }
    }

    /**
     * testTime
     */
    public function actionTesttime($time){

        $diff = 600;
        if($time && time()>$time+$diff){
            return $this->actionLogout();
        }
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->render('index');
//        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set('logintime',time());
            return $this->redirect(['site/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Signup action.
     *
     * @return string
     */
    public function actionSign(){

        $model = new SignForm();
        if($model->load(Yii::$app->request->post()) && $user = $model->signup()){
            if(Yii::$app->getUser()->login($user)) {
                return $this->redirect(['site/index']);
            }
        }
        return $this->render('sign',[
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/site/login']);
    }

}

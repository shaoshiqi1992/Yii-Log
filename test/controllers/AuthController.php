<?php
namespace app\controllers;

use app\models\LoginForm;
use app\models\User;

class AuthController extends BaseAPIController
{
    public function actionIndex()
    {

        $model = new LoginForm();

        $post = array(
            'LoginForm' => \Yii::$app->request->post()
        );
//        print_r([
//            "post"=>$model->load($post),
//            "test"=>$model->login(),
//            "getu"=>$model->username,
//            "val"=>$model->validate(),
//            "user"=>$model->getUser()]);
//        exit(0);
        if ($model->load($post) && $model->login()) {

            return ['success'=>1,'msg'=>$model->token];
        }
        return ['success'=>0,'msg'=>'wrong username or password.'];
    }
    public function actionLogout(){
        \Yii::$app->user->logout();

        return ['success'=>1,'msg'=>'logout success'];
    }
}
<?php
namespace app\controllers;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class UserController extends BaseAPIController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            $behaviors['authenticator'] = [
                'class' => HttpBearerAuth::className(),
            ];
        }
        return $behaviors;
    }
    public function actionIndex()
    {
        return ['success'=>1,'msg'=>'hello','username'=>Yii::$app->user->identity->username,'test1'=>Yii::$app->redis->get('test1')];
    }
}
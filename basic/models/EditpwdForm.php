<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EditpwdForm extends Model{
    public $oldpwd;
    public $repeatpwd;
    public $newpwd;

    public $_user=false;

    public function rules(){
        return [
            [['oldpwd','repeatpwd','newpwd'],'required'],
            [['oldpwd','repeatpwd','newpwd'],'string','min'=>4],
            ['oldpwd','validatePwd'],
            ['repeatpwd','compare','compareAttribute'=>'newpwd','operator'=>'===','message'=>'重复密码应与新密码相同'],
        ];
    }

    public function validatePwd($attribute){
        if(!$this->getErrors()){
            $user = $this->getUser();
            if (!$user->validatePassword($this->oldpwd)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }

    }

    public function editpwd(){
        if($this->validate()){
            $user = $this->_user;
            $user->setPassword($this->newpwd);
            return true;
        }else{
            return false;
        }
    }

    public function getUser(){
        if(!$this->_user){
            $this->_user = Users::findOne(Yii::$app->user->identity->id);//Users::findByUsername(Yii::$app->user->identity->username);
        }
        return $this->_user;
    }

}
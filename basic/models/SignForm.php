<?php
/**
 * Created by PhpStorm.
 * User: Shao
 * Date: 22/11/2017
 * Time: 18:26
 */

namespace app\models;

use Yii;
use yii\base\Model;


class SignForm extends Model{

    public $username;
    public $password;
    public $repeatpwd;
    public $authKey;
    public $cre_time;

    public function rules(){
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message' => '用户名不能为空'],
            ['username', 'match', 'pattern' => '/^[a-z]\w*[a-z0-9]$/i'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username','unique','targetClass' =>'\app\models\Users','message' => '用户已存在'],
            ['password', 'required','message' => '密码不能为空'],
            ['password', 'string', 'min' => 4],
            ['repeatpwd', 'required','message' => '重复密码不能为空'],
            ['repeatpwd', 'string','min' => 4],
            ['repeatpwd', 'compare','compareAttribute' => 'password','operator'=>'===', 'message'=>'重复密码应与密码相同']
            //['repeatpwd', 'validRepeatPwd']
        ];
    }

//    public function validRepeatPwd($attribute){
//        if($this->repeatpwd!==$this->password){
//            $this->addError($attribute, 'The repeat password should be same as password.');
//        }
//
//    }

    public function signup()
    {
        if($this->validate()){
            $user = new Users();
            $user->username = $this->username;
            $user->password = md5($this->password);
            $user->cre_time = time();
            $user->generateAuthKey();
            if($user->save()){
                return $user;
            }

        }
        return null;
    }
}

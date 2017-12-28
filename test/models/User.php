<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /*public $id;
        public $username;
        public $password;
        public $authKey;
        public $accessToken;

        private static $users = [
            '100' => [
                'id' => '100',
                'username' => 'admin',
                'password' => 'admin',
                'authKey' => 'test100key',
                'accessTokwaen' => '100-token',
            ],
            '101' => [
                'id' => '101',
                'username' => 'demo',
                'password' => 'demo',
                'authKey' => 'test101key',
                'accessToken' => '101-token',
            ],
        ];
    */

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = self::find()
            ->where(['username' => "admin"])
            ->asArray()
            ->one();

        if($user){
            return new static($user);
        }

        return null;
        //return static::findOne(['access_token' => $token]);
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     *
     */
    public static function findByUsername($username)
    {
        $user = self::find()->where(['username' => $username])->one();


        if($user){
            return $user;
        }

        return null;
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
        $this->save();
    }

    public function setPassword($password)
    {
        $this->password = $password;
        $this->save();
    }

    public function generateAccessToken(){
        $this->accessToken = Yii::$app->security->generateRandomString();
        $this->save();
        return $this->accessToken;

//        print_r($this);exit;
//
//
//        print_r($this->isNewRecord);
//        exit(0);
//        $this->save(true,["accessToken"]);
    }
}



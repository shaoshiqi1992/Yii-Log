<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="login-wrapper">

    <div class="login-title">
        <video loop muted autoplay class="background">
            <source src="/img/opera-mini.webm" type="video/webm">
        </video>
    </div>
    <div class="container-fluid">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>"
        ],
    ]); ?>
        <div class="col-lg-12 text-center text-info">
            <h3>Log In</h3>
        </div>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'Username']) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])?>

        <div class="col-lg-12">
            <?= Html::a('Sign Up',['site/sign'],['class'=> 'btn btn-warning col-lg-5 mybutton'])?>
            <div class="col-lg-2"></div>
            <?= Html::submitButton('Login', ['class' => 'btn btn-success col-lg-5 mybutton', 'name' => 'login-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>

</div>

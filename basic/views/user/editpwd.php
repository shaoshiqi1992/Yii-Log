<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<div class="login-wrapper">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin([
            'id' => 'reset-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "<div class=\"col-lg-12\">{input}</div><div class=\"col-lg-12\">{error}</div>"
            ],
        ]); ?>
        <div class="col-lg-12 text-center text-info">
            <h3>Edit Password</h3>
        </div>
        <div class="col-lg-12"><br></div>
        <?= $form->field($model, 'oldpwd')->passwordInput(['placeholder'=>'Old Password'])?>

        <?= $form->field($model, 'newpwd')->passwordInput(['placeholder'=>'New Password'])?>

        <?= $form->field($model, 'repeatpwd')->passwordInput(['placeholder'=>'Repeat Password'])?>

        <div class="col-lg-12">
            <?= Html::submitButton('Confirm', ['class' => 'btn btn-success col-lg-5 mybutton']) ?>
            <div class="col-lg-2"></div>
            <?= Html::a('Cancel',['site/index'],['class'=> 'btn btn-warning col-lg-5 mybutton'])?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
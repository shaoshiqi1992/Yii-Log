<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>

<?php
Yii::$app->runAction('site/testtime',['time'=>Yii::$app->session->get('logintime')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii Login Practice',
        'brandUrl' => '/site/index',//Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    try {
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Index', 'url' => ['site/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Sign up', 'url' => ['site/sign'], 'visible' => Yii::$app->user->isGuest],
                ['label' => Yii::$app->user->identity->username,
                    'items' => [
                        ['label' => 'Reset Password', 'url' => ['user/editpwd']],

                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'dropdown-form'])
                        . Html::submitButton(
                            'Logout',
                            ['class' => 'btn-text btn-link']
                        )
                        . Html::endForm()
                        . '</li>'
                    ],
                    'visible' => !Yii::$app->user->isGuest
                ]
            ],

        ]);
    } catch (Exception $e) {
    }
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>

    </div>
</div>

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

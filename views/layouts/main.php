<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo "
       <div class='navbar-left navbar-left-items'>
            <span>Klienditeenindus</span>
            <span><i class='glyphicon glyphicon-stop'></i> 1715</span>
            <span><i class='glyphicon glyphicon-globe'></i> E-P 9.00-21.00</span>
        </div>
    ";
    echo "
       <div class='navbar-right navbar-right-items'>
            <span>Tere, Kaupo kasutaja</span>
            <button class='btn'> Log out <i class='glyphicon glyphicon-log-out'></i></button>
        </div>
    ";
    NavBar::end();
    ?>

    <div class="container">
        <div class="row">

            <div class="col col-md-4 col-xs-5 site-logo">
                <a href="https://www.creditstar.com/">
                    <span>CREDIT</span>
                    <span>STAR</span>
                </a>
            </div>

            <div class="col col-md-4 col-xs-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://www.creditstar.com/" title="CreditStar home page">Home</a></li>
                        <li class="breadcrumb-item"><a href="https://www.creditstar.com/about" title="About CreditStar">About</a></li>
                        <li class="breadcrumb-item"><a href="https://www.creditstar.com/careers" title="Career at CreditStar">Careers</a></li>
                    </ol>
                </nav>
            </div>

            <div class="col col-md-4 col-xs-2">
                <div class="no-pyc pull-right">
                    No-pycckn
                </div>
            </div>


        </div>
    </div>
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-gray',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'My actions', 'url' => ['/myactions'], 'linkOptions' => ['class' => Yii::$app->controller->id == 'myactions' ? 'active-link' : '']],
            ['label' => 'Users', 'url' => ['/user'], 'linkOptions' => ['class' => Yii::$app->controller->id == 'user' ? 'active-link' : '']],
            ['label' => 'Loans', 'url' => ['/loan'], 'linkOptions' => ['class' => Yii::$app->controller->id == 'loan' ? 'active-link' : '']],
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container">
    <?= Alert::widget() ?>
        <div class="main-content">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

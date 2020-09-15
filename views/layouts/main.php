<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 01/06/2020 21:05
 */

use models\Page;
use widgets\Form;

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $content string */
/* @var $page models\Page */

//$keywords = ArrayHelper::getValue($this->params, 'keywords', '');
//$description = ArrayHelper::getValue($this->params, 'description', '');
//$currentAlias = ArrayHelper::getValue($this->params, 'currentAlias', '');

$page = ArrayHelper::getValue($this->params, 'page');
$urlBase = Url::base(true);
$pageTitle = Html::encode('Pickazzo' . ($page->title ? ' - ' : '') . $page->title);
$appUser = Yii::$app->user;
$breadcrumbs = ArrayHelper::getValue($this->params, 'breadcrumbs', []);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <?php $this->registerCsrfMetaTags() ?>
    <meta name="keywords" content="<?= Html::encode($page->keywords) ?>">
    <meta name="description" content="<?= Html::encode($page->description) ?>">
    <title><?= $pageTitle ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,600;0,700;1,400&display=swap">
    <link rel="stylesheet" href="/css/main.depends.css?v=115">
    <link rel="stylesheet" href="/css/main.css?v=115">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= $urlBase ?>/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $urlBase ?>/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $urlBase ?>/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $urlBase ?>/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= $urlBase ?>/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= $urlBase ?>/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="<?= $urlBase ?>/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= $urlBase ?>/favicon-16x16.png" sizes="16x16">
    <meta name="application-name" content="Pickazzo">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?= $urlBase ?>/mstile-144x144.png">
</head>
<body>
<?php $this->beginBody() ?>

<header class="header" id="header-1">
    <div class="container-fluid">
        <div class="row align-items-center">

            <div class="col-auto d-xl-none">
                <span class="toggle" data-toggle="#navbar-1" data-parent="#header-1"></span>
            </div><!-- /.col -->

            <div class="col-auto d-none d-xl-block">
                <div class="header-logo">
                    <a class="logo-ln" href="<?= Url::home() ?>">
                        <img class="header-logo-img" src="/img/logo.svg" alt="Pickazzo">
                    </a>
                    <p class="header-logo-txt">Первая галлерея<br>нейрохудожников</p>
                </div>
            </div><!-- /.col -->

            <div class="col"></div>

            <?php if (!Yii::$app->user->isGuest): ?>
                <?php
                    /* @var $user models\User */
                    $user = Yii::$app->user->identity;
                    $productCount = $user->productCount;
                ?>
                <div class="col-auto js-cart <?= ($productCount) ? '' : 'd-none' ?>">
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <div class="ucart">
                                <i class="i-cart d-sm-none"></i>
                                <span class="ucart-txt d-none d-sm-block">Корзина</span>
                                <span class="ucart-count animate__animated animate__fast js-cart-count">
                                    <?= StringHelper::truncate($productCount, 2, '..') ?>
                                </span>
                            </div>
                            <div class="dropdown-content bottom-center">
                                <p class="ws-nowrap right mb-1">
                                    <span class="bold js-cart-price"><?= $user->totalPrice ?></span>
                                    руб.
                                </p>
                                <a class="btn btn-sm btn-blue mb-2" href="<?= Url::to(['user/cart']) ?>">Купить</a>
                            </div>
                        </div><!-- .dropdown -->
                    </div><!-- .d-flex -->
                </div><!-- /.col -->
            <?php endif; ?>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <div class="dropdown-btn">
                            <img class="dropdown-btn-img" height="18" src="/img/ru.svg">
                            <span class="dropdown-btn-txt">Ru</span>
                        </div>
                        <div class="dropdown-content bottom-right">
                            <a class="dropdown-ln" href="">
                                <img height="16" src="/img/ru.svg">
                                <span class="ml-2">Русский</span>
                            </a>
                            <a class="dropdown-ln" href="">
                                <img height="16" src="/img/en.svg">
                                <span class="ml-2">English</span>
                            </a>
                        </div>
                    </div><!-- .dropdown -->
                </div><!-- .d-flex -->
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</header>

<div class="navbar" id="navbar-1">
    <div class="navbar-logo mt-auto d-xl-none">
        <a class="logo-ln" href="<?= Url::home() ?>">
            <img class="navbar-logo-img" src="/img/logo.svg" alt="Pickazzo">
        </a>
    </div>

    <nav class="nav mt-auto">
        <?php foreach (Page::navItems() as $navItem): ?>
            <?php
                $navUrl = Url::to(['site/index', 'alias' => $navItem->alias]);
                if ($navItem->default === 1) $navUrl = Url::home();
            ?>
            <?php if ($navItem->alias === 'prodano'): ?>
                <a class="btn btn-sm btn-tred nav-btn" href="<?= $navUrl ?>">
                    <?= $navItem->menu_label ?>
                </a>
            <?php else: ?>
                <a class="nav-ln" href="<?= $navUrl ?>">
                    <?= $navItem->menu_label ?>
                </a>
            <?php endif; ?>
            <span class="w-100"></span>
        <?php endforeach; ?>
        <?php if ($appUser->isGuest): ?>
            <a class="btn btn-sm btn-blue nav-btn"
               data-fancybox
               data-src="#login-register"
               href="javascript:">Войти</a>
        <?php else: ?>
            <p class="text mb-0 mt-2">
                Привет, <?= $appUser->identity->username ?>!
            </p>
            <a class="btn btn-sm btn-blue nav-btn"
               href="<?= Url::to(['user/logout']) ?>">Выйти</a>
        <?php endif; ?>
    </nav>
    <p class="navbar-txt center italic mt-auto">
        Все картины созданы нейросетями в единственном экземпляре и никогда не будут повторены!
    </p>
    <nav class="soc mt-auto">
        <a class="soc-ln" href="">
            <i class="i-tw soc-i"></i>
        </a>
        <a class="soc-ln" href="">
            <i class="i-fb soc-i"></i>
        </a>
        <a class="soc-ln" href="">
            <i class="i-ins soc-i"></i>
        </a>
        <a class="soc-ln" href="">
            <i class="i-in soc-i"></i>
        </a>
        <a class="soc-ln" href="">
            <i class="i-vm soc-i"></i>
        </a>
        <a class="soc-ln" href="">
            <i class="i-sh soc-i"></i>
        </a>
    </nav>
    <p class="text gray center my-auto">
        <small>Copyright © All rights reserved.</small>
    </p>
</div><!-- /.navbar -->

<div class="wrapper">

    <?php if ($breadcrumbs): ?>
        <div class="container">
            <nav class="breadcrumb">
                <a href="<?= Url::home() ?>" class="breadcrumb-item">
                    <i class="i-home"></i>
                </a>
                <?php foreach ($breadcrumbs as $bItem): ?>
                    <?php
                        $bUrl = ArrayHelper::getValue($bItem, 'url', '');
                        $bLabel = ArrayHelper::getValue($bItem, 'label', '');
                    ?>
                    <?php if ($bUrl === ''): ?>
                        <span class="breadcrumb-item">
                            <?= $bLabel ?>
                        </span>
                    <?php else: ?>
                        <a href="<?= Url::to($bUrl) ?>" class="breadcrumb-item">
                            <?= $bLabel ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>
        </div>
    <?php endif; ?>

    <?= $content ?>

</div><!-- /.wrapper -->

<!-- MODALS -->
<div class="d-none">

    <div class="modal" id="login-register">
        <div class="tab">
            <a class="tab-btn active" data-tab="#login" href="javascript:;">Вход</a>
            <a class="tab-btn" data-tab="#registr" href="javascript:;">Регистрация</a>
        </div>
        <div class="" id="login">
            <?php $formLogin = Form::begin([
                'model' => new models\Login(),
                'formId' => 'form-login',
                'action' => ['user/login'],
            ]); ?>
                <?= $formLogin->inputText('email') ?>
                <?= $formLogin->inputPassword('password') ?>
                <?= $formLogin->error('form') ?>
                <?= $formLogin->checkbox('remember') ?>
                <?= $formLogin->submit('Войти') ?>
            <?php Form::end(); ?>
            <div class="inwith">
                <span class="inwith-icon"><i class="i-fb"></i></span>
                <span class="inwith-icon"><i class="i-vk"></i></span>
                <span class="inwith-icon"><i class="i-goo"></i></span>
            </div>
        </div>
        <div class="d-none" id="registr">
            <?php $formReg = Form::begin([
                'model' => new models\Registr(),
                'formId' => 'form-registr',
                'action' => ['/user/registr'],
            ]); ?>
                <?= $formReg->inputText('username') ?>
                <?= $formReg->inputText('email') ?>
                <?= $formReg->inputPassword('password') ?>
                <?= $formReg->inputPassword('password_repeat') ?>
                <?= $formReg->checkbox('subscribe') ?>
                <p class="gray"><small>При регистрации вы соглашаетесь с нашими Условиями пользования , а также Политикой Конфиденциальности и Cookie</small></p>
                <?= $formReg->submit('Зарегистрироваться') ?>
            <?php Form::end(); ?>
        </div>
    </div><!-- .modal -->

    <div class="modal" id="register-success">
        <div class="center">
            <h3 class="bold">Регистрация прошла успешно!</h3>
            <p>На указанную вами почту придёт письмо с подтверждением регистрации.</p>
        </div>
    </div>

    <div class="modal" id="email-confirm-success">
        <div class="center">
            <h3 class="bold">Поздравляем!</h3>
            <p>Ваш аккаунт был успешно активирован. Теперь Вы можете использовать логин (email) и пароль для входа в Личный кабинет.</p>
        </div>
    </div>

    <div class="modal" id="contrib-success">
        <div class="center">
            <h3 class="bold">Ваш запрос успешно принят</h3>
            <p>Мы с вами обязательно свяжемся!</p>
        </div>
    </div><!-- .modal -->

</div><!-- .d-none -->

<?php $this->endBody() ?>

<script src="/js/main.depends.js?v=115"></script>
<script src="/js/main.js?v=115"></script>

<?php if (Yii::$app->session->getFlash('is-email-confirm', false)): ?>
    <script>
        $.fancybox.open({
            src: '#email-confirm-success',
            type: 'inline'
        });
    </script>
<?php endif; ?>

</body>
</html>
<?php $this->endPage() ?>
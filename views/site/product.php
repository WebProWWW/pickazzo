<?php

use yii\helpers\Url;

use widgets\Form;

/* @var $view yii\web\View */
/* @var $page models\Page */

$appUser = Yii::$app->user;

$product = $page->product;

$this->params['breadcrumbs'] = [
    [
        'url' => ['site/index', 'alias' => $page->parent->parent->alias],
        'label' => $page->parent->parent->title,
    ],
    [
        'url' => ['site/index', 'alias' => $page->parent->alias],
        'label' => $page->parent->title,
    ],
]

?>
<div class="container">
    <h1 class="bold"><?= $product->title ?></h1>
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6">
            <div class="gslider">
                <div class="gslider-view js-slider-view" id="slider-view-1" data-nav="#slider-nav-1">
                    <?php foreach ($product->images as $image): ?>
                        <div>
                            <img
                                width="600" height="600"
                                class="gslider-view-img"
                                data-lazy="<?= $image->url ?>"
                                data-fancybox="gal-1"
                                data-src="<?= $image->url ?>"
                            >
                        </div>
                    <?php endforeach; ?>
                </div><!-- /.gslider-view -->
                <div class="gslider-nav js-slider-nav" id="slider-nav-1" data-view="#slider-view-1">
                    <?php foreach ($product->images as $image): ?>
                        <div><img class="gslider-nav-img" width="200" height="200" src="<?= $image->url ?>"></div>
                    <?php endforeach; ?>
                </div><!-- /.gslider-nav -->
            </div><!-- /.gslider -->
        </div><!-- /.col -->
        <div class="col-12 col-md-5 ml-auto">
            <p>
                <span class="bold">Художник:</span> <?= $product->author ?>
                <br>
                <span class="bold">Картины:</span> <?= $product->title ?>
                <br>
                <span class="bold">Нейросеть:</span> StarGAN v2
                <br>
                <span class="bold">Артикул:</span> <?= $product->artikul ?>
                <br>
                <span class="bold">Размер:</span> <?= $product->size ?>
            </p>
            <p class="bold mb-1">Описание:</p>
            <div class="editor">
                <?= $product->description ?>
            </div>
            <p>
                <span class="bold">Цена:</span> <?= number_format($product->price, 0, 0, ' ') ?> рублей
            </p>
            <div class="row no-gutters">
                <div class="col-auto mr-2">
                    <?php if ($appUser->isGuest): ?>
                        <a class="btn btn-blue"
                           data-fancybox
                           data-src="#login-register"
                           href="javascript:;">
                                <i class="i-cart mr-2"></i>
                                Добавить в корзину
                        </a>
                    <?php else: ?>
                        <?php
                            /* @var $user models\User */
                            $user = $appUser->identity;
                            $hasProduct = $user->hasProduct($product->id);
                        ?>
                        <a
                            class="btn btn-blue js-to-cart <?= $hasProduct ? '' : 'd-none' ?>"
                            href="<?= Url::to(['user/cart']) ?>"
                        >
                            <i class="i-cart mr-2"></i>
                            Перейти в корзину
                        </a>
                        <?php $formCart = Form::begin([
                            'model' => $product,
                            'action' => ['/user/create-order'],
                            'formId' => 'form-product',
                            'formClass' => $hasProduct ? 'd-none' : '',
                        ]); ?>
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                            <?= $formCart->submit('<i class="i-cart mr-2"></i> Добавить в корзину') ?>
                        <?php Form::end(); ?>
                    <?php endif; ?>
                </div><!-- /.col -->
                <div class="col-auto mr-2">
                    <span class="btn btn-white"><i class="i-hrt"></i></span>
                    <!-- <span class="btn btn-white active"><i class="i-hrt"></i></span> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <h2 class="center">Другие работы художника</h2>

    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="cart">
                <a class="cart-ln" href="">
                    <div class="cart-img-wrap">
                        <img class="cart-img" width="500" height="500" src="img/sub-cat-1.jpg">
                    </div>
                </a>
            </div><!-- /.cart -->
        </div><!-- /.col -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="cart">
                <a class="cart-ln" href="">
                    <div class="cart-img-wrap">
                        <img class="cart-img" width="500" height="500" src="img/sub-cat-2.jpg">
                    </div>
                </a>
            </div><!-- /.cart -->
        </div><!-- /.col -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="cart">
                <a class="cart-ln" href="">
                    <div class="cart-img-wrap">
                        <img class="cart-img" width="500" height="500" src="img/sub-cat-3.jpg">
                    </div>
                </a>
            </div><!-- /.cart -->
        </div><!-- /.col -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="cart">
                <a class="cart-ln" href="">
                    <div class="cart-img-wrap">
                        <img class="cart-img" width="500" height="500" src="img/sub-cat-4.jpg">
                    </div>
                </a>
            </div><!-- /.cart -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->
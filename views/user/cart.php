<?php

use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user models\User */

$user = Yii::$app->user->identity;

?>
<div class="container">
    <h1 class="bold">Корзина</h1>
</div>
<?php if ($user->productCount): ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-5 ml-auto">
                <div class="wall">
                    <div class="row">
                        <div class="col-auto">
                            <p>Количество</p>
                            <p>К оплате</p>
                        </div><!-- .col -->
                        <div class="col">
                            <p class="bold"><?= $user->productCount ?></p>
                            <h3><span class="bold"><?= $user->totalPrice ?></span>&nbsp;руб.</h3>
                        </div><!-- .col -->
                    </div><!-- .row -->
                    <a class="btn btn-blue">Купить</a>
                </div><!-- .wall -->
            </div><!-- .col -->
        </div><!-- .row -->
        <?php foreach ($user->products as $product): ?>
            <div class="wall">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <img class="cont-img" width="500" height="500" src="<?= $product->image->url ?>">
                    </div><!-- /.col -->
                    <div class="col-12 col-md">
                        <div class="row no-gutters align-items-center justify-content-end">
                            <!--
                            <div class="col-auto">
                                <label class="checkbox">
                                    <input type="checkbox" checked name="">
                                    <span class="checkbox-style"></span>
                                </label>
                            </div>
                            <div class="col-auto mr-3">
                                <a class="btn btn-white" href="">
                                    <i class="i-hrt"></i>
                                </a>
                            </div>
                            -->
                            <div class="col-auto">
                                <?= Html::beginForm(['user/remove-product']) ?>
                                    <input type="hidden" name="id" value="<?= $product->id ?>">
                                    <button class="btn btn-white" type="submit">
                                        <i class="i-trash"></i>
                                    </button>
                                <?= Html::endForm() ?>
                            </div><!-- .col -->
                        </div><!-- .row -->
                        <p>
                            <span class="bold">Художник:</span> <?= $product->author ?>
                            <br><span class="bold">Картины:</span> <?= $product->title ?>
                            <br><span class="bold">Нейросеть:</span> <?= $product->neuro ?>
                            <br><span class="bold">Артикул:</span> <?= $product->artikul ?>
                            <br><span class="bold">Размер:</span> <?= $product->size ?>
                        </p>
                        <p class="bold mb-1">Описание:</p>
                        <div class="row align-items-end">
                            <div class="col-12 col-lg">
                                <div class="editor">
                                    <?= StringHelper::truncate($product->description, 110) ?>
                                </div>
                            </div><!-- .col -->
                            <div class="col-12 col-lg-auto">
                                <h3 class="right">
                                    <span class="bold">Цена:</span>
                                    <?= $product->formatPrice ?>&nbsp;руб.
                                </h3>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.wall -->
        <?php endforeach; ?>
    </div><!-- .container -->
<?php else: ?>
    <div class="container my-auto">
        <div class="h1 center">
            <i class="i-cart"></i>
            <br>
            Ваша корзина пуста
        </div>
        <div class="row">
            <div class="col-auto mx-auto">
                <a class="btn btn-blue btn-sm" href="<?= Url::home() ?>">НА ГЛАВНУЮ</a>
            </div>
        </div>
    </div><!-- .container -->
<?php endif; ?>
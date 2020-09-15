<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $page models\Page */

$this->params['breadcrumbs'] = [
    [
        'url' => ['site/index', 'alias' => $page->parent->alias],
        'label' => $page->parent->title,
    ],
]

?>
<div class="container">
    <h1 class="bold"><?= $page->title ?></h1>

    <div class="row align-items-center justify-content-center">
        <div class="col-auto">
            <!-- <img class="ava" src="img/ava.png"> -->
            <span class="ava-black"></span>
        </div><!-- /.col -->
        <div class="col-auto">
            <p>
                <span class="bold">Имя при рождении:</span> Cloud Mone
                <br>
                <span class="bold">Дата рождения:</span> 01 января 2020 года
                <br>
                <span class="bold">Дата смерти:</span> 01 апреля 2020 года
            </p>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <p class="center">
        Первый нейрохудожник созданный на базе нейронной сети StarGan v2. За 4 месяца работы было создано 350 картин
        <br>
        1 апреля 2020 года конфигурация нейронной сети была уничтожена и никогда не будет запущена вновь.
        <br>
        Все картины созданы в единственном экземплере.
    </p>

    <div class="row">
        <?php foreach ($page->childs as $childPage): ?>
            <?php $product = $childPage->product ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="cart">
                    <a class="cart-ln" href="<?= Url::to(['site/index', 'alias' => $childPage->alias ]) ?>">
                        <div class="cart-img-wrap">
                            <img class="cart-img" width="500" height="500" src="<?= $product->image->url ?>">
                        </div>
                        <h3 class="center cart-title">
                            <span class="bold"><?= $product->author ?></span>
                            <br>
                            <span class="italic"><?= $product->title ?></span>
                        </h3>
                    </a>
                </div><!-- /.cart -->
            </div><!-- /.col -->
        <?php endforeach; ?>
    </div><!-- /.row -->
</div><!-- /.container -->
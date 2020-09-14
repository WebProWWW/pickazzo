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
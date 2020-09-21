<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $page models\Page */

?>
<div class="container">
    <h1 class="bold"><?= $page->title ?></h1>
    <div class="row">
        <?php foreach ($page->childs as $childPage): ?>
            <?php
                $category = $childPage->productCategory;
                $url = Url::to(['site/index', 'alias' => $childPage->alias]);
                $count = $childPage->childCount;
            ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="cart">
                    <a class="cart-ln" href="<?= $url ?>">
                        <div class="cart-img-wrap">
                            <img class="cart-img" width="500" height="500" src="<?= $category->image->url ?>">
                            <div class="cart-img-content">
                                <h3 class="mb-0"><?= $childPage->title ?></h3>
                                <?php if ($count): ?>
                                    <p><small><?= $count ?> картин</small></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div><!-- /.cart -->
            </div><!-- /.col -->
        <?php endforeach; ?>
    </div><!-- /.row -->
</div><!-- /.container -->
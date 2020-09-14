<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 02/06/2020 22:27
 */

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $exception yii\web\NotFoundHttpException */
/* @var $name string */
/* @var $message string */

?>
<div class="container my-auto center">
    <div class="h1">404</div>
    <div class="h1">Страница не найдена</div>
    <div class="row">
        <div class="col-auto mx-auto">
            <a class="btn btn-blue btn-sm" href="<?= Url::home() ?>">НА ГЛАВНУЮ</a>
        </div>
    </div>
    <?php if (YII_ENV_DEV): ?>
    <div class="left">
        <pre><?= "{$name}\n{$message}" ?></pre>
    </div>
    <?php endif; ?>
</div>
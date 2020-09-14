<?php

use widgets\Form;
use yii\helpers\Url;

?>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
            <img class="cont-img" width="180" src="/img/logo.svg" alt="Pickazzo">
            <h1 class="center bold">Сотрудничество</h1>
            <p>Pickazzo - приглашает к сотрудничеству всех заинтересованных людей, художников, творческих личностей, гиков, и просто хороших людей. Все свои запросы можно оставить в форме ниже, мы с вами обязательно свяжемся!</p>


            <?php $formContrib = Form::begin([
                'model' => new models\Contrib(),
                'action' => ['site/contrib'],
                'formId' => 'form-contrib',
            ]) ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $formContrib->inputText('username') ?>
                        <?= $formContrib->inputText('email') ?>
                        <?= $formContrib->inputText('phone') ?>
                    </div><!-- .col -->
                    <div class="col-12 col-md-6">
                        <?= $formContrib->textarea('message', ['rows' => 8]) ?>
                        <?= $formContrib->inputFile('file') ?>
                    </div><!-- .col -->
                </div><!-- .row -->
                <?= $formContrib->checkbox('agree') ?>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <?= $formContrib->submit('Отправить') ?>
                    </div>
                </div>
            <?php Form::end(); ?>

        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
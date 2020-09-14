<?php

/* @var $this yii\web\View */
/* @var $model models\Contrib */

?>
<p>
    <strong><?= $model->getAttributeLabel('username') ?></strong>
    <br>
    <?= $model->username ?>
</p>
<p>
    <strong><?= $model->getAttributeLabel('email') ?></strong>
    <br>
    <?= $model->email ?>
</p>
<p>
    <strong><?= $model->getAttributeLabel('phone') ?></strong>
    <br>
    <?= $model->phone ?>
</p>
<p>
    <strong><?= $model->getAttributeLabel('message') ?></strong>
    <br>
    <?= $model->message ?>
</p>
<p>
    <strong>IP</strong>
    <br>
    <?= Yii::$app->request->remoteIP ?>
</p>

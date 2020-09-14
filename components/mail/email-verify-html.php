<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['user/verify-email', 'token' => $user->email_confirm_token]);
?>
<div class="verify-email">
    <p>Здравствуйте <?= Html::encode($user->username) ?>!</p>

    <p>Перейдите по ссылке ниже, чтобы подтвердить свою электронную почту:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>

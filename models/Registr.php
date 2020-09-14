<?php


namespace models;


use components\Access;

use Yii;
use yii\base\Model;

/**
 * Class Registr
 * @package site\forms
 *
 */
class Registr extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $subscribe=true;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            ['password', 'compare'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            ['subscribe', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Подтвердите пароль',
            'subscribe' => 'Подписаться на рассылку',
        ];
    }

    public function create()
    {
        if ($this->validate()) {
            $user = new User([
                'username' => $this->username,
                'email' => $this->email,
                'subscribe' => $this->subscribe,
                'role' => Access::ROLE_USER,
                'status' => Access::STATUS_WAIT,
                'auth_key' => Yii::$app->security->generateRandomString(32),
                'api_key' => Yii::$app->security->generateRandomString(32),
                'password_hash' => Yii::$app->security->generatePasswordHash($this->password),
                'email_confirm_token' => Yii::$app->security->generateRandomString(),
            ]);
            if ($user->save()) {
                $from = Yii::$app->params['mailer.noreply'];
                $to = [$this->email => $this->username];
                return Yii::$app
                    ->mailer
                    ->compose('email-verify-html', ['user' => $user])
                    ->setFrom($from)
                    ->setTo($to)
                    ->setSubject('Активация аккаунта ' . Yii::$app->name)
                    ->send();
            }
            return false;
        }
        return false;
    }
}
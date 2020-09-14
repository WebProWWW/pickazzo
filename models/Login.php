<?php


namespace models;

use components\Access;
use Yii;
use yii\base\Model;


/**
 * Class Login
 * @package site\forms
 *
 * @property string $email
 * @property string $password
 * @property boolean $remember
 * @property User $user
 * @property User $_user
 */
class Login extends Model
{
    public $email;
    public $password;
    public $remember = true;
    private $_user;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['remember', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array|string[]
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'remember' => 'Запомнить меня',
        ];
    }

    /**
     * @param string $attr
     * @param array $params
     */
    public function validatePassword($attr, $params)
    {
        if (!$this->hasErrors()) {
            if ($user = $this->user and $user->validatePassword($this->password)) {
                if ($user->status === Access::STATUS_WAIT) {
                    $this->addError('form', ''
                        .'Ваш аккаунт не активирован.'
                        .'<br>'
                        .'Инструкция по акцивации отправлена на ваш email: ('.$user->email .')'
                    .'');
                }
                if ($user->status === Access::STATUS_BLOCK) {
                    $this->addError('form', 'Ваш аккаунт заблокирован.');
                }
            } else {
                $this->addError('form', 'Неверный email или пароль');
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->user, $this->remember ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }
}
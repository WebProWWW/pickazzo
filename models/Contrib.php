<?php


namespace models;

use Yii;
use yii\base\Model;

class Contrib extends Model
{

    public $username;
    public $email;
    public $phone;
    public $message;
    public $agree;
    public $file;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'phone'], 'required'],
            ['agree', 'validateAgree'],
            ['email', 'email'],
            ['phone', 'string'],
            ['message', 'string'],
            ['file', 'safe']
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'message' => 'Сообщение',
            'agree' => 'Даю согласие на обработку своих персональных данных',
            'file' => 'Прикрепить файл к сообщению',
        ];
    }

    public function validateAgree($attr)
    {
        if ($this->agree !== '1') {
            $this->addError($attr, 'Дайте согласие');
        }
    }

    /**
     * @return bool
     */
    public function send()
    {
        if ($this->validate()) {
            $from = Yii::$app->params['mailer.noreply'];
            $to = Yii::$app->params['mailer.admins'];
            return Yii::$app
                ->mailer
                ->compose('contrib', ['model' => $this])
                ->setFrom($from)
                ->setTo($to)
                ->setSubject('Сотрудничество ' . Yii::$app->name)
                ->send();
        }
        return false;
    }

}
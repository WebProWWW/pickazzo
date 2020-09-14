<?php

namespace models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use components\Access;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $status
 * @property string $role
 * @property string $username
 * @property string $email
 * @property string|null $email_confirm_token
 * @property string $api_key
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $subscribe
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'api_key', 'auth_key', 'password_hash'], 'required'],
            [['role', 'username', 'email', 'email_confirm_token', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['api_key', 'auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['email_confirm_token'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'role' => 'Role',
            'username' => 'Username',
            'email' => 'Email',
            'email_confirm_token' => 'Email Confirm Token',
            'api_key' => 'Api Key',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'subscribe' => 'Подписаться на рассылку',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param string $email
     * @return User|null
     */
    public static function findByEmail($email)
    {
        return self::findOne([
            // 'status' => Access::STATUS_ACTIVE,
            'email' => $email,
        ]);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function confirmEmail($token)
    {
        $user = self::findOne([
            'status' => Access::STATUS_WAIT,
            'email_confirm_token' => $token,
        ]);
        if ($user) {
            $user->email_confirm_token = null;
            $user->status = Access::STATUS_ACTIVE;
            return $user->save();
        }
        return false;
    }

    /*
     * IdentityInterface
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id, 'status' => Access::STATUS_ACTIVE]);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['api_key' => $token, 'status' => Access::STATUS_ACTIVE]);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}

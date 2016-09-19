<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $role
 * @property string $link
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $gender
 * @property string $email
 * @property string $ip_addr
 * @property string $user_agent
 * @property integer $created
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role', 'link', 'name', 'gender', 'email', 
                'ip_addr', 'user_agent', 'created'], 'required'],
            [['name', 'username'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 64],
            [['ip_addr'], 'string', 'max' => 16],
            [['link'], 'string', 'max' => 128],
            [['gender'], 'string', 'max' => 6],
            [['role'], 'string', 'max' => 5],

            [['id', 'created'], 'integer'],
            [['user_agent'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'link' => 'Link',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'gender' => 'Gender',
            'email' => 'Email address',
            'ip_addr' => 'Ip Address',
            'user_agent' => 'User Agent',
            'created' => 'Created',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::find()->all() as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * @param $username
     * @return null|static
     */
    public static function findByUsername($username)
    {
        $users = self::find()->all();

        foreach ($users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()
            ->validatePassword($password, $this->password);
        // return $this->password === $password;
    }
}

<?php

namespace app\models;

use Yii;

class User extends BaseModel implements \yii\web\IdentityInterface
{
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @return string
     */
    public static function typeName()
    {
        return 'user';
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['username', 'password'], 'required'],
            [['username', 'password', 'password_hash', 'email'], 'string', 'max' => 255],
            [['status'], 'integer'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'username' => 'Логин',
            'password_hash' => 'Пароль',
            'password' => 'Пароль',
            'email' => 'E-mail',
            'status' => 'Статус',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
        //return $this->password === $password;
    }

    public function beforeSave($insert)
    {
        if($this->password and !$this->password_hash) {
            $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
        }
        if(!$this->auth_key) {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }
        return parent::beforeSave($insert);
    }
}

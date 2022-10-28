<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $name;
    public $phone;
    public $genre;
    public $birth;
    public $country;
    public $city;
    public $morada;
    public $typeUser;
    public $biography;
    public $password_hash;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este username já existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este email já existe.'],

            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este Número já existe.'],
            ['phone', 'number'],

            ['genre', 'required'],

            ['birth', 'required'],

            ['country', 'required'],

            ['city', 'required'],

            ['morada', 'required'],
            ['morada', 'string'],

            ['typeUser', 'required'],

            ['biography', 'required'],
            ['biography', 'string'],

            ['password_hash', 'required'],
            ['password_hash', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password_hash', 'message'=>"As Palavras-passe não Combinam" ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->genre = $this->genre;
        $user->birth = $this->birth;
        $user->country = $this->country;
        $user->city = $this->city;
        $user->morada = $this->morada;
        $user->biography = $this->biography;
        $user->plan_start_date = date('Y-m-d');
        $user->plan_id = 1;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->save(false);

        $auth = \Yii::$app->authManager;

        $clientRole = $auth->getRole($this->typeUser);
        $auth->assign($clientRole, $user->getId());

        return $user;
    }

    /*public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->genre = $this->genre;
        $user->country = $this->country;
        $user->city = $this->city;
        $user->morada = $this->morada;
        $user->birth_date = $this->birth_date;
        $user->biography = $this->biography;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save() && $this->sendEmail($user);
    }*/

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}

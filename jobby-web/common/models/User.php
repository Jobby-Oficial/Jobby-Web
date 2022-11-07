<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use frontend\models\Favorite;
use common\models\Schedule;

/**
 * User model
 *
 * @property integer $id
 * @property string $image
 * @property string $username
 * @property string $name
 * @property integer $phone
 * @property string $genre
 * @property string $country
 * @property string $city
 * @property string $morada
 * @property string $biography
 * @property string $password_repeat
 * @property integer $typeUser
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $typeUser;
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            [['username', 'email', 'name', 'phone', 'genre', 'birth', 'country', 'city', 'morada', 'biography', 'status', 'typeUser', 'password', 'password_repeat', 'plan_start_date' , 'plan_id'], 'required'],
            [['username', 'email'], 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este username já existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            [['email'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este email já existe.'],

            [['typeUser'], 'safe'],

            // [['image'],'file'],

            [['password'], 'safe'],

            [['password_repeat'], 'safe'],

            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este Número já existe.'],

            [['birth', 'plan_start_date'], 'date', 'format' => 'php:Y-m-d'],

            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"As Palavras-passe não Combinam" ],

            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['plan_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }
    /*public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }*/

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
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
        return $this->getAuthKey() === $authKey;
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
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            // 'image' => Yii::t('app', 'Imagem'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Nome'),
            'phone' => Yii::t('app', 'Telefone'),
            'genre' => Yii::t('app', 'Género'),
            'birth' => Yii::t('app', 'Data de Nascimento'),
            'country' => Yii::t('app', 'País'),
            'city' => Yii::t('app', 'Cidade'),
            'morada' => Yii::t('app', 'Morada'),
            'biography' => Yii::t('app', 'Biografia'),
            'status' => Yii::t('app', 'Status'),
            'password' => Yii::t('app', 'Password'),
            'plan_start_date' => Yii::t('app', 'Começo do Plano'),
            'plan_end_date' => Yii::t('app', 'Final do Plano'),
            'highlight_date_end' => Yii::t('app', 'Fim do Destaque'),
            'plan_id' => Yii::t('app', 'Plano'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Avaliations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliations()
    {
        return $this->hasMany(Avaliation::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[SchedulesClient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedulesClient()
    {
        return $this->hasMany(Schedule::className(), ['client_id' => 'id']);
    }

    /**
     * Gets query for [[SchedulesProfessional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedulesProfessional()
    {
        return $this->hasMany(Schedule::className(), ['professional_id' => 'id']);
    }
}

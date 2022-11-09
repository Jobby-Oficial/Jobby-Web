<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "avaliation".
 *
 * @property int $id
 * @property float $avaliation
 * @property int $service_id
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Service $service
 * @property User $user
 */
class Avaliation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliation';
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
            /*[['avaliation', 'service_id', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['avaliation'], 'number'],
            [['service_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],*/

            [['avaliation', 'service_id', 'user_id'], 'required'],
            [['service_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['avaliation'], 'double'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            /*'id' => 'ID',
            'avaliation' => 'Avaliation',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',*/

            'id' => Yii::t('app', 'ID'),
            'avaliation' => Yii::t('app', 'Avaliação'),
            'service_id' => Yii::t('app', 'Serviço'),
            'user_id' => Yii::t('app', 'Utilizador'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

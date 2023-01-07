<?php

namespace common\models;

use Bluerhinos\phpMQTT;
use Yii;
use yii\behaviors\TimestampBehavior;
use frontend\models\Favorite;
use common\models\ServiceGallery;
use common\models\Schedule;
use yii\helpers\Json;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property int $price
 * @property float $rating_average
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
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
            [['category', 'name', 'description', 'price', 'user_id'], 'required'],
            [['description'], 'string'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['rating_average', 'price'], 'number'],
            [['category', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Categoria',
            'name' => 'Nome',
            'description' => 'Descrição',
            'price' => 'Preço',
            'rating_average' => 'Classificação',
            'user_id' => 'Utilizador',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['service_id' => 'id']);
    }

    /**
     * Gets query for [[ServiceGalleries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceGalleries()
    {
        return $this->hasMany(ServiceGallery::class, ['service_id' => 'id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::class, ['service_id' => 'id']);
    }

    /**
     * Gets query for [[Avaliations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliations()
    {
        return $this->hasMany(Avaliation::class, ['service_id' => 'id']);
    }
}

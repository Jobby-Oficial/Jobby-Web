<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property float $price
 * @property float|null $rating_average
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Avaliation[] $avaliations
 * @property Favorite[] $favorites
 * @property Schedule[] $schedules
 * @property ServiceGallery[] $serviceGalleries
 * @property User $user
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
    public function rules()
    {
        return [
            [['category', 'name', 'description', 'price', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['price', 'rating_average'], 'number'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['category', 'name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'rating_average' => 'Rating Average',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::class, ['service_id' => 'id']);
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "plan".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $num_service
 * @property int $num_highlight
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User[] $users
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
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
            [['name', 'description', 'price', 'num_service', 'num_highlight', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['num_service', 'num_highlight', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'num_service' => 'Num Service',
            'num_highlight' => 'Num Highlight',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['plan_id' => 'id']);
    }
}

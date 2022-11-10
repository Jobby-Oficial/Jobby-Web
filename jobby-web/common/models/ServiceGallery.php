<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use Bluerhinos\phpMQTT;
use yii\helpers\Json;

/**
 * This is the model class for table "service_gallery".
 *
 * @property int $id
 * @property string $image
 * @property int $service_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Service $service
 */
class ServiceGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_gallery';
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

    // public function afterSave($insert, $changedAttributes) {
    //     parent::afterSave($insert, $changedAttributes);

    //     $serviceGallery = new ServiceGallery(); 

    //     $serviceGallery->id = $this->id; 
    //     $serviceGallery->image = $this->image; 
    //     $serviceGallery->service_id = $this->service_id;

    //     $serviceJson = Json::encode($serviceGallery);

    //     if($insert){
    //         $this->FazPublish("Atualizacao Servico", $serviceJson);
    //     }
    // }

    // public function afterDelete() {
    //     parent::afterDelete();

    //     $gallery_id = $this->id;

    //     $serviceGallery = new ServiceGallery(); 
    //     $serviceGallery->id = $gallery_id;

    //     $myJSON = Json::encode($serviceGallery);

    //     $this->FazPublish("Apagar Imagem Servico", $myJSON); 
    // }

    // public function FazPublish($canal,$msg)
    // {
    //     $server = "localhost";
    //     $port = 1883;
    //     $username = ""; // set your username
    //     $password = ""; // set your password
    //     $client_id = "phpMQTT-publisher"; // unique!
    //     $mqtt = new phpMQTT($server, $port, $client_id);
        
    //     if ($mqtt->connect(true, NULL, $username, $password)){
    //         $mqtt->publish($canal, $msg, 0);
    //         $mqtt->close();
    //     }
    //     else { 
    //         file_put_contents("debug.output","Time out!"); 
    //     }
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'service_id'], 'required'],
            [['service_id', 'created_at', 'updated_at'], 'integer'],
            [['image'], 'image', 'extensions' => 'png, jpg, gif, svg, jpeg', 'maxFiles' => 5],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Imagem'),
            'service_id' => Yii::t('app', 'Serviço'),
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
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}

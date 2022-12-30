<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $service_date
 * @property string $service_time
 * @property string|null $note
 * @property int $payment
 * @property int|null $schedule_status
 * @property string|null $schedule_status_note
 * @property int $job_status_id
 * @property int $service_id
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property JobStatus $jobStatus
 * @property Service $service
 * @property User $user
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
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
            /*[['service_date', 'service_time', 'service_id', 'professional_id', 'client_id', 'created_at', 'updated_at'], 'required'],
            [['service_date', 'service_time'], 'safe'],
            [['note', 'schedule_status_note'], 'string'],
            [['payment', 'schedule_status', 'job_status_id', 'service_id', 'professional_id', 'client_id', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['client_id' => 'id']],
            [['job_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobStatus::class, 'targetAttribute' => ['job_status_id' => 'id']],
            [['professional_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['professional_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],*/

            [['service_date', 'service_time', 'note', 'price', 'service_id', 'professional_id', 'client_id'], 'required'],
            [['service_date', 'service_time'], 'safe'],
            [['note', 'schedule_status_note'], 'string'],
            [['payment', 'schedule_status', 'job_status_id', 'service_id', 'created_at', 'updated_at'], 'integer'],
            [['job_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobStatus::className(), 'targetAttribute' => ['job_status_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['professional_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['professional_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            /*'id' => 'ID',
            'service_date' => 'Service Date',
            'service_time' => 'Service Time',
            'note' => 'Note',
            'payment' => 'Payment',
            'schedule_status' => 'Schedule Status',
            'schedule_status_note' => 'Schedule Status Note',
            'price' => 'Price',
            'job_status_id' => 'Job Status ID',
            'service_id' => 'Service ID',
            'professional_id' => 'Professional ID',
            'client_id' => 'Client ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',*/

            'id' => Yii::t('app', 'ID'),
            'service_date' => Yii::t('app', 'Data do Serviço'),
            'service_time' => Yii::t('app', 'Tempo do Serviço'),
            'note' => Yii::t('app', 'Nota'),
            'payment' => Yii::t('app', 'Pagamento'),
            'schedule_status' => Yii::t('app', 'Status do Agendamento'),
            'schedule_status_note' => Yii::t('app', 'Motivo'),
            'price' => Yii::t('app', 'Preço'),
            'job_status_id' => Yii::t('app', 'Status do Serviço'),
            'service_id' => Yii::t('app', 'Serviço'),
            'professional_id' => Yii::t('app', 'Profissional'),
            'client_id' => Yii::t('app', 'Cliente'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[JobStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobStatus()
    {
        return $this->hasOne(JobStatus::class, ['id' => 'job_status_id']);
    }

    /**
     * Gets query for [[Professional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfessional()
    {
        return $this->hasOne(User::class, ['id' => 'professional_id']);
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
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }
}

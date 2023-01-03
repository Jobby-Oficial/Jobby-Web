<?php

namespace frontend\controllers;

use common\models\Schedule;
use common\models\JobStatus;
use common\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use Imagine\Image\Box;
use yii\imagine\Image;
use common\models\Service;
use common\models\ServiceGallery;

class ScheduleController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'update', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schedule();
        $modelService = Service::find()->where(['id' => $this->request->post()['Schedule']['service_id']])->one();
        //dd($modelService);

        $model->service_date = $this->request->post()['Schedule']['service_date'];
        $model->service_time = $this->request->post()['Schedule']['service_time'];
        $model->note = $this->request->post()['Schedule']['note'];
        $model->price = $this->request->post()['Schedule']['price'];
        $model->professional_id = $modelService->user->id;
        $model->client_id = \Yii::$app->user->identity->id;
        $model->service_id = $modelService->id;
        $model->save();

        \Yii::$app->mailer->compose()
            ->setFrom([$model->client->email])
            ->setTo([$model->professional->email])
            ->setSubject($model->service->name)
            ->setHtmlBody('Olá Sr/Sra. ' . $model->professional->name . '!<br><br>Você tem um agendamento para o serviço ' . $model->service->name . ' para o dia ' . $model->service_date . ' às ' . $model->service_time . '.<br><br>Para mais informações, acesse o seguinte <a href="http://localhost/jobby-web/frontend/web/profile/' . $model->professional->id . '">link</a>')
            ->send();

        return $this->redirect(['view', 'id' => $model->id]);

    }

    /**
     * Displays a single Schedule model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $auth = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id);
        //dd($auth['developer']->name);
        //dd($auth);
        foreach ($auth as $keyType=>$type){
            if ($auth[$keyType]->name == 'consumer')
                $data = JobStatus::find()->all();
            else{
                $data = JobStatus::find()->where("name != 'Esperando Aprovação'")->all();
            }
        }


        if($this->request->isPost){
            if($this->request->post('stripeToken')){
                $model = $this->findModel($id);
                $model->payment = 1;
                $model->save();

                if($model->payment == 1){
                    \Yii::$app->mailer->compose()
                        ->setFrom([$model->professional->email])
                        ->setTo([$model->client->email])
                        ->setSubject($model->service->name)
                        ->setHtmlBody('Olá Sr/Sra. ' . $model->client->name . '!<br><br>O seu pagamento fou Concluído para o Serviço ' . $model->service->name . ' para o dia ' . $model->service_date . ' às ' . $model->service_time . '.<br><br>Para mais informações, acesse o seguinte <a href="http://localhost/jobby-web/frontend/web/schedule/view?id=' . $model->id . '">link</a>')
                        ->send();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'status' => \yii\helpers\ArrayHelper::map($data, 'id', 'name')
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($this->request->isPost){
            if($this->request->post('response') != null){
                $model->schedule_status = $this->request->post('response');

                if($this->request->post('price') != null){
                    $model->price = $this->request->post('price');
                }

                if($this->request->post('reason') != ""){
                    $model->schedule_status_note = $this->request->post('reason');
                }
                else{
                    $job_status = JobStatus::find()->where(['name' => 'Não Começou'])->one();
                    $model->job_status_id = $job_status->id;
                }

                if($this->request->post('response') == 1){
                    $from = $model->professional->email;
                    $to = $model->client->email;
                    $message = 'Olá Sr/Sra. ' . $model->client->name . '!<br><br>O seu agendamento para o serviço ' . $model->service->name . ' para o dia ' . $model->service_date . ' às ' . $model->service_time . ' foi aprovado.<br><br>Para mais informações, acesse o seguinte <a href="http://localhost/jobby-web/frontend/web/schedule/view?id=' . $model->id. '">link</a>';
                }
                else{
                    if($model->professional->id == \Yii::$app->user->identity->id){
                        $from = $model->professional->email;
                        $to = $model->client->email;
                        $message = 'Olá Sr/Sra. ' . $model->client->name . '!<br><br>O seu agendamento para o serviço ' . $model->service->name . ' para o dia ' . $model->service_date . ' às ' . $model->service_time . ' foi cancelado.<br><br>Para mais informações, acesse o seguinte <a href="http://localhost/jobby-web/frontend/web/schedule/view?id=' . $model->id . '">link</a>';
                    }
                    else{
                        $from = $model->client->email;
                        $to = $model->professional->email;
                        $message = 'Olá Sr/Sra. ' . $model->professional->name . '!<br><br>O seu Trabalho para o serviço ' . $model->service->name . ' para o dia ' . $model->service_date . ' às ' . $model->service_time . ' foi cancelado.<br><br>Para mais informações, acesse o seguinte <a href="http://localhost/jobby-web/frontend/web/schedule/view?id=' . $model->id . '">link</a>';
                    }
                }

                \Yii::$app->mailer->compose()
                    ->setFrom([$from])
                    ->setTo([$to])
                    ->setSubject($model->service->name)
                    ->setHtmlBody($message)
                    ->send();
            }
            else{
                $job_status = JobStatus::find()->where(['id' => $this->request->post('job_status')])->one();
                $model->job_status_id = $job_status->id;

                if($model->jobStatus->name == 'Concluído'){
                    \Yii::$app->mailer->compose()
                        ->setFrom([$model->professional->email])
                        ->setTo([$model->client->email])
                        ->setSubject($model->service->name)
                        ->setHtmlBody('Olá Sr/Sra. ' . $model->client->name . '!<br><br>O serviço requisitado por si ' . $model->service->name . ' para o dia ' . $model->service_date . ' às ' . $model->service_time . ' foi Concluído.<br>É necessário efetuar o pagamento do serviço.<br><br>Para mais informações, acesse o seguinte <a href="http://localhost/jobby-web/frontend/web/schedule/view?id=' . $model->id . '">link</a>')
                        ->send();
                }

            }

            $model->save();
        }

    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}

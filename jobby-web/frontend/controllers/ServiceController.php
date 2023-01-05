<?php

namespace frontend\controllers;

use common\models\Service;
use common\models\ServiceGallery;
use common\models\Avaliation;
use common\models\Report;
use common\models\Schedule;
use frontend\models\Favorite;
use common\models\ServiceSearch;
use common\models\UserSearch;
use edofre\fullcalendar\models\Event;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use Imagine\Image\Box;
use yii\imagine\Image;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'delete-gallery'],
                            'allow' => true,
                            'roles' => ['?', '@'],
                        ],
                        [
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Service models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $searchModelUser = new UserSearch();
        $dataProvider = $searchModel->searchService($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'searchModelUser' => $searchModelUser,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Service model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelSchedule = new Schedule();
        $avaliationsCount = Avaliation::find()->where(['service_id' => $model->id])->count();
        $schedules = Schedule::find()->where(['service_id' => $id, 'schedule_status' => 1])->all();

        $events[] = [];

        foreach($schedules as $keySchedule => $schedule){
            $events[$keySchedule] = new Event([
                'id' => $schedule->id,
                'title' => $schedule->service->name,
                'start' => $schedule->service_date . 'T' . $schedule->service_time,
                'end' => $schedule->service_date . 'T' . $schedule->service_time,
            ]);
        }

        /* if($this->request->isPost){
            ServiceController::actionCreateSchedule($this->request->post(), $model, $modelSchedule);
        } */

        return $this->render('view', [
            'model' => $model,
            'modelSchedule' => $modelSchedule,
            'avaliationsCount' => $avaliationsCount,
            'schedules' => $events
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /* public function actionCreateSchedule($data, $model, $modelSchedule)
    {
        $modelSchedule->service_date = $data['Schedule']['service_date'];
        $modelSchedule->service_time = $data['Schedule']['service_time'];
        $modelSchedule->note = $data['Schedule']['note'];
        $modelSchedule->price = $data['Schedule']['price'];
        $modelSchedule->professional_id = $model->user->id;
        $modelSchedule->client_id = \Yii::$app->user->identity->id;
        $modelSchedule->service_id = $model->id;
        $modelSchedule->save();

        \Yii::$app->mailer->compose()
            ->setFrom([$modelSchedule->client->email])
            ->setTo([$modelSchedule->professional->email])
            ->setSubject($modelSchedule->service->name)
            ->setHtmlBody('Olá Sr/Sra. ' . $modelSchedule->professional->name . '!<br><br>Você tem um agendamento para o serviço ' . $modelSchedule->service->name . ' para o dia ' . $modelSchedule->service_date . ' às ' . $modelSchedule->service_time . '.<br><br>Para mais informações, acesse o seguinte <a href="http://localhost:20080/profile/' . $modelSchedule->professional->id . '">link</a>')
            ->send();

        return $this->redirect(['view', 'id' => $model->id]);
    } */

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Service();
        $modelServiceGallery = new ServiceGallery();

        if ($this->request->isPost) {
            //dd($this->request->post());
            if ($model->load($this->request->post()) && $model->save()) {
                $images = UploadedFile::getInstances($modelServiceGallery, 'image');

                foreach($images as $img){
                    $modelServiceGallery = new ServiceGallery();
                    $imageName = 'service-' . $model->name . '-' . time();
                    $path = 'uploads/services/' . $model->id;
                    if (!is_dir($path)) {
                        \yii\helpers\FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
                        $img->saveAs('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension);
                        Image::thumbnail('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension, 1110, 600)->resize(new Box(1110, 600))->save('uploads/services/' . $model->id . '/' . $imageName . '.' . $img->extension, ['quality' => 90]);
                        unlink('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension);
                    }
                    else{
                        //$img->saveAs('uploads/services/' . $model->id . '/' . $imageName . '.' . $img->extension);
                        $img->saveAs('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension);
                        Image::thumbnail('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension, 1110, 600)->resize(new Box(1110, 600))->save('uploads/services/' . $model->id . '/' . $imageName . '.' . $img->extension, ['quality' => 90]);
                        unlink('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension);
                    }
                    $modelServiceGallery->image = \Yii::getAlias('@frontendImage') . '/uploads/services/' . $model->id . '/' . $imageName . '.' . $img->extension;
                    $modelServiceGallery->service_id = $model->id;
                    $modelServiceGallery->save();
                }

                \Yii::$app->session->setFlash('success', 'O Serviço foi criado com Sucesso!');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelServiceGallery' => $modelServiceGallery
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelServiceGallery = new ServiceGallery();

        if($this->request->isPost){
            if(!isset($this->request->post()["ServiceGallery"])){
                if ($model->load($this->request->post()) && $model->save()) {
                    \Yii::$app->session->setFlash('success', 'O Serviço foi atualizado com Sucesso!');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else{
                $images = UploadedFile::getInstances($modelServiceGallery, 'image');

                foreach($images as $keyImg => $img){
                    $model = $this->findModel($id);
                    if(count($model->serviceGalleries) < 5){
                        $modelServiceGallery = new ServiceGallery();
                        $imageName = 'service-' . $model->name . '-' . time() . '-' . $keyImg;
                        $img->saveAs('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension);
                        Image::thumbnail('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension, 1110, 600)->resize(new Box(1110, 600))->save('uploads/services/' . $model->id . '/' . $imageName . '.' . $img->extension, ['quality' => 90]);
                        unlink('uploads/services/' . $model->id . '/original-' . $imageName . '.' . $img->extension);
                        $modelServiceGallery->image = \Yii::getAlias('@frontendImage') . '/uploads/services/' . $model->id . '/' . $imageName . '.' . $img->extension;
                        $modelServiceGallery->service_id = $model->id;
                        $modelServiceGallery->save();

                        \Yii::$app->session->setFlash('success', 'A Galeria do Serviço foi Atualizada com Sucesso!');
                    }
                    else{
                        $warning = "Um Serviço só pode conter no Máximo 5 Imagens na Galeria!!!";

                        return $this->render('update', [
                            'model' => $model,
                            'modelServiceGallery' => $modelServiceGallery,
                            'warning' => $warning
                        ]);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelServiceGallery' => $modelServiceGallery
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $avaliations = Avaliation::find()->where(['service_id' => $id])->all();
        //$reports = Report::find()->where(['service_id' => $id])->all();
        $serviceGalleries = ServiceGallery::find()->where(['service_id' => $id])->all();
        $schedules = Schedule::find()->where(['service_id' => $id])->all();

        foreach($avaliations as $avaliation){
            $avaliation->delete();
        }

        /*foreach($reports as $report){
            $report->delete();
        }*/

        foreach($serviceGalleries as $serviceGallery){
            $serviceGallery->delete();
        }

        foreach($schedules as $schedule){
            $schedule->delete();
        }

        $this->findModel($id)->delete();

        \Yii::$app->session->setFlash('success', 'O Serviço foi Eliminado com Sucesso!');

        return $this->redirect(['profile/' . \Yii::$app->user->identity->id]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteGallery($id)
    {
        $model = ServiceGallery::find()->where(['service_id' => $id, 'id' => $this->request->post()['galleryId']])->one();
        $model->delete();
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
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}

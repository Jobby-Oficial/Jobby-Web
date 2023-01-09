<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Service;
use common\models\Report;
use common\models\ScheduleSearch;
use frontend\models\Favorite;
use common\models\Schedule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'update'],
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
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        $services = Service::find()->where(['user_id' => $id])->all();
        $favorites = Favorite::find()->where(['user_id' => $id])->all();
        //$favoritesServices = Favorite::find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
        $jobs = Schedule::find()->where(['professional_id' => $id])->orderBy('service_date ASC')->all();
        $schedules = Schedule::find()->where(['client_id' => $id])->orderBy('service_date ASC')->all();
        $modelReport = new Report();

        $arrFav = null;
        if (isset(\Yii::$app->user->identity->id)) {
            $modelFavorite = Favorite::find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
            $modelService = Service::find()->all();

            foreach($modelService as $service){
                $arrFav[$service->id] = 0;
                foreach($modelFavorite as $favorite){
                    if($favorite->service_id == $service->id){
                        $arrFav[$service->id] = $favorite->id;
                    }
                }
            }
        }

        // $arrFav = array();

        // foreach($services as $service){
        //     foreach($favoritesServices as $favorite){
        //         if($favorite->service_id == $service->id){
        //             $arrFav[] = 1;
        //             break;
        //         }
        //         else{
        //             $arrFav[] = 0;
        //             break;
        //         }
        //     }
        // }

        // foreach($favoritesServices as $favorite){
        //     foreach($services as $service){
        //         if($favorite->service_id == $service->id){
        //             $arrFav[] = 1;
        //         }
        //     }
        // }

        /* $pos = 0;
        foreach($services as $service){
            $arrFav[$pos] = 0;
            foreach($favoritesServices as $favorite){
                if($favorite->service_id == $service->id){
                    $arrFav[$pos] = 1;
                }
            }
            $pos++;
        } */

        return $this->render('view', [
            'model' => $this->findModel($id),
            'user' => $user,
            'services' => $services,
            'favorites' => $favorites,
            'jobs' => $jobs,
            'schedules' => $schedules,
            'modelReport' => $modelReport,
            'favoritesServices' => $arrFav,
            //'favoritesServices' => $favoritesServices
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($this->request->isPost){
            /* $imageName = 'user-' . $model->username . '-' . time();
            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image != null){
                $model->image->saveAs('uploads/users/' . $imageName . '.' . $model->image->extension);
                $model->image = \Yii::getAlias('@frontendImage') . '/uploads/users/' . $imageName . '.' . $model->image->extension;
            }
            else{
                $model->image = '/assets/img/user-profile.svg';
            } */

            if ($model->load($this->request->post()) && $model->save()) {
                $manager = \Yii::$app->authManager;
                $items = $manager->getRoles($this->request->post()['User']['typeUser']);
                foreach($items as $item){
                    $manager->revoke($item, $model->getId());
                }

                $authorRole = $manager->getRole($this->request->post()['User']['typeUser']);
                $manager->assign($authorRole, $model->getId());

                \Yii::$app->session->setFlash('success', 'O Utilizador foi Atualizado com Sucesso.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
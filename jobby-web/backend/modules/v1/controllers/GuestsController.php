<?php

namespace backend\modules\v1\controllers;

use common\models\Service;
use common\models\ServiceGallery;
use common\models\User;
use yii\rest\ActiveController;

class GuestsController extends ActiveController
{
    public $modelClass = 'frontend\models\Favorite';

    public function actions()
    {
        return array_merge(parent::actions(), [
            'create' => null,
            'view' => null,
            'update' => null,
            'delete' => null,
            'index' => null
        ]);
    }

    public function actionRegister(){
        $user = new User();
        $user->username = \Yii::$app->request->post('username');
        $user->email = \Yii::$app->request->post('email');
        $user->name = \Yii::$app->request->post('name');
        $user->phone = \Yii::$app->request->post('phone');
        $user->genre = \Yii::$app->request->post('genre');
        $user->birth = \Yii::$app->request->post('birth');
        $user->country = \Yii::$app->request->post('country');
        $user->city = \Yii::$app->request->post('city');
        $user->morada = \Yii::$app->request->post('morada');
        $user->biography = \Yii::$app->request->post('biography');
        $user->plan_start_date = date('Y-m-d');
        $user->plan_id = 1;
        $user->setPassword(\Yii::$app->request->post('password'));
        $user->generateAuthKey();
        $user->save(false);

        $auth = \Yii::$app->authManager;

        $clientRole = $auth->getRole(\Yii::$app->request->post('typeUser'));
        $auth->assign($clientRole, $user->getId());

        return ['response' => "Utilizador Criado com Sucesso"];
    }

    public function actionLogin(){
        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');

        $result = User::find()->where(['username' => $username])->one();

        if(\Yii::$app->getSecurity()->validatePassword($password, $result->password_hash)){
            return $result;
        }
        else{
            throw new \yii\web\NotFoundHttpException;
        }
    }

    public function actionGetServices(){
        $services = Service::find()->all();

        return $services;
    }

    public function actionGetServicesGallery(){
        $servicesGallery = ServiceGallery::find()->all();

        return $servicesGallery;
    }
}

<?php

namespace backend\modules\v1\controllers;

use common\models\User;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `v1` module
 */
class UsersController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        return array_merge(parent::actions(), [
            'create' => null
        ]);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'get' or $action === 'put' or $action === 'delete'){
            if (\Yii::$app->user->isGuest) {
                throw new \yii\web\ForbiddenHttpException('Apenas poderá ' . $action . ' utilizadores registados...');
            }
        }
    }

    public function actionUpdateUser($id){
        $user = User::find()->where(['id' => $id])->one();
        $user->username = \Yii::$app->request->post('username');
        $user->email = \Yii::$app->request->post('email');
        $user->name = \Yii::$app->request->post('name');
        $user->phone = \Yii::$app->request->post('phone');

        $user->save(false);

        return ['response' => "Utilizador Atualizado com Sucesso"];
    }

    /* public function actionLogin(){
        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');

        $result = $this->modelClass::find()->where(['username' => $username])->one();

        if(\Yii::$app->getSecurity()->validatePassword($password, $result->password_hash)){
            return ['response' => $result];
        }
        else{
            throw new \yii\web\NotFoundHttpException;
        }
    } */
}

<?php

namespace backend\modules\v1\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class ServicesController extends ActiveController
{
    public $modelClass = 'common\models\Service';

    public function behaviors()
    {
        $behaviors = parent::behaviors(); $behaviors['authenticator'] = [
        'class' => QueryParamAuth::className(),
    ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'post' or $action === 'delete'){
            if (\Yii::$app->user->isGuest) {
                throw new \yii\web\ForbiddenHttpException('Apenas poderá ' . $action . ' utilizadores registados...');
            }
        }
    }

    /* public function fields()
    {
        return [
            'user_id' => function ($model) {
                return $model->user->username; // Return related model property, correct according to your structure
            },
        ];
    } */

    public function actionGetServiceFromUserId(){
        $user_id = \Yii::$app->request->post('user_id');

        $result = $this->modelClass::find()->where(['user_id' => $user_id])->all();

        if(isset($result)){
            return ['response' => $result];
        }
        else{
            throw new \yii\web\NotFoundHttpException;
        }
    }
}

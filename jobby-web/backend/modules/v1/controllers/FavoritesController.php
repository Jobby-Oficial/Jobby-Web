<?php

namespace backend\modules\v1\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class FavoritesController extends ActiveController
{
    public $modelClass = 'frontend\models\Favorite';

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

    public function actionGetFavoriteFromUserId(){
        $user_id = \Yii::$app->request->post('user_id');

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = $this->modelClass::find()->where(['user_id' => $user_id])->all();

        if(isset($result)){
            return $result;
        }
        else{
            throw new \yii\web\NotFoundHttpException;
        }
    }
}

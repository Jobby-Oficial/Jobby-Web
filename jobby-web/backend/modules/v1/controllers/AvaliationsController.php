<?php

namespace backend\modules\v1\controllers;

use common\models\Avaliation;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * Default controller for the `Module` module
 */
class AvaliationsController extends ActiveController
{
    public $modelClass = 'common\models\Avaliation';

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

    public function actionGetAvaliationsFromUserId(){
        $avaliations = Avaliation::find()->where(['user_id' => \Yii::$app->request->post('user_id')])->all();

        return $avaliations;
    }
}

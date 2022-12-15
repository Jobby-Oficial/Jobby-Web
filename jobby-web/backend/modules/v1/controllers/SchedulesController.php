<?php

namespace backend\modules\v1\controllers;

use common\models\Schedule;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class SchedulesController extends ActiveController
{
    public $modelClass = 'common\models\Schedule';

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

    public function actionGetSchedulesFromClientId(){
        $schedules = Schedule::find()->where(['client_id' => \Yii::$app->request->post('client_id')])->all();

        return $schedules;
    }
}

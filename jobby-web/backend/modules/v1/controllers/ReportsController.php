<?php

namespace backend\modules\v1\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class ReportsController extends ActiveController
{
    public $modelClass = 'common\models\Report';

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
}

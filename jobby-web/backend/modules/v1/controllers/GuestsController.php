<?php

namespace backend\modules\v1\controllers;

class GuestsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

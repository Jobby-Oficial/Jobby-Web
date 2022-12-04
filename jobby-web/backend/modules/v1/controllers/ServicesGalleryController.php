<?php

namespace backend\modules\v1\controllers;

class ServicesGalleryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

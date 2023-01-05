<?php

namespace frontend\controllers;

use common\models\Report;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class ReportController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create'],
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
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();
        $user = $this->request->get('user_id');
        //$users = ArrayHelper::map(User::find()->all(), 'id', 'username');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                \Yii::$app->session->setFlash('success', 'A Denúncia foi criada com Sucesso!');

                return $this->redirect(['user/view', 'id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user
        ]);
    }
}

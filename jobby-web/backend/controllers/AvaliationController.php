<?php

namespace backend\controllers;

use common\models\Service;
use common\models\User;
use common\models\Avaliation;
use common\models\AvaliationSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvaliationController implements the CRUD actions for Avaliation model.
 */
class AvaliationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        /*[
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['developer'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'roles' => ['@'],
                        ],*/
                        [
                            'actions' => ['index'],
                            'allow' => true,
                            'roles' => ['indexAvaliationBackoffice'],
                        ],
                        [
                            'actions' => ['view'],
                            'allow' => true,
                            'roles' => ['viewAvaliationBackoffice'],
                        ],
                        [
                            'actions' => ['create'],
                            'allow' => true,
                            'roles' => ['createAvaliationBackoffice'],
                        ],
                        [
                            'actions' => ['update'],
                            'allow' => true,
                            'roles' => ['updateAvaliationBackoffice'],
                        ],
                        [
                            'actions' => ['delete'],
                            'allow' => true,
                            'roles' => ['deleteAvaliationBackoffice'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Avaliation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AvaliationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avaliation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Avaliation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Avaliation();

        $services = ArrayHelper::map(Service::find()->all(), 'id', 'name');
        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $this->actionRatingAvaliation($model->service_id);

                \Yii::$app->session->setFlash('success', 'A Avaliação foi Criada com Sucesso!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'services' => $services,
            'users' => $users
        ]);
    }

    /**
     * Updates an existing Avaliation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $services = ArrayHelper::map(Service::find()->all(), 'id', 'name');
        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $this->actionRatingAvaliation($model->service_id);

            \Yii::$app->session->setFlash('success', 'A Avaliação foi Atualizada com Sucesso!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'services' => $services,
            'users' => $users
        ]);
    }

    /**
     * Deletes an existing Avaliation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $avaliations = Avaliation::findOne($id);
        $this->findModel($id)->delete();
        $this->actionRatingAvaliation($avaliations->service_id);

        \Yii::$app->session->setFlash('success', 'A Avaliação foi Eliminada com Sucesso!');

        return $this->redirect(['index']);
    }

    public function actionRatingAvaliation($id){
        $services = Service::find()->where(['id' => $id])->one();
        $avaliations = Avaliation::find()->where(['service_id' => $id])->all();
        $avaliationsCount = Avaliation::find()->where(['service_id' => $id])->count();

        if ($avaliationsCount != 0) {
            $aux = 0;
            foreach ($avaliations as $avaliation) {
                $aux += $avaliation->avaliation;
            }
            $avaliations = ($aux / $avaliationsCount);
        }
        else {
            $avaliations = "0.0";
        }

        $services->rating_average = $avaliations;
        $services->validate();
        $services->save();
    }

    /**
     * Finds the Avaliation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Avaliation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avaliation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

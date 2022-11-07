<?php

namespace backend\controllers;

use common\models\Plan;
use common\models\User;
use common\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'update'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create', 'delete'],
                            'roles' => ['admin', 'developer'],
                        ],
                    ],
                ]
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        $plans = ArrayHelper::map(Plan::find()->all(), 'id', 'name');

        if ($this->request->isPost) {
            $imageName = 'user-' . $model->username . '-' . time();
            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image != null){
                $model->image->saveAs('uploads/users/' . $imageName . '.' . $model->image->extension);
                $model->image = \Yii::getAlias('@backendImage') . '/uploads/users/' . $imageName . '.' . $model->image->extension;
            }
            else{
                $model->image = '/assets/img/user-profile.svg';
            }
            $model->plan_start_date = date('Y-m-d');
            $model->setPassword($this->request->post()["User"]["password"]);
            $model->generateAuthKey();
            if ($model->load($this->request->post()) && $model->save()) {

                $auth = \Yii::$app->authManager;

                $role = $auth->getRole($this->request->post()["User"]["typeUser"]);
                $auth->assign($role, $model->getId());

                \Yii::$app->session->setFlash('success', 'O Utilizador foi criado com Sucesso!');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }/* else {
            $model->loadDefaultValues();
        }*/

        return $this->render('create', [
            'model' => $model,
            'plans' => $plans,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->getId() == $id) {
            $model = $this->findModel($id);

            $plans = ArrayHelper::map(Plan::find()->all(), 'id', 'name');

            if ($this->request->isPost) {
                $imageName = 'user-' . $model->username . '-' . time();
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->image != null){
                    $model->image->saveAs('uploads/users/' . $imageName . '.' . $model->image->extension);
                    $model->image = \Yii::getAlias('@backendImage') . '/uploads/users/' . $imageName . '.' . $model->image->extension;
                }
                else{
                    $model->image = '/assets/img/user-profile.svg';
                }
                if($model->load($this->request->post()) && $model->save()){
                    $manager = \Yii::$app->authManager;
                    $items = $manager->getRoles($this->request->post()['User']['typeUser']);
                    foreach($items as $item){
                        $manager->revoke($item, $model->getId());
                    }

                    $authorRole = $manager->getRole($this->request->post()['User']['typeUser']);
                    $manager->assign($authorRole, $model->getId());

                    \Yii::$app->session->setFlash('success', 'O Utilizador foi Atualizado com Sucesso!');

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'plans' => $plans,
            ]);
        }
        else{
            throw new ForbiddenHttpException("Não tem permissões para Alterar este Perfil", 403);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        \Yii::$app->session->setFlash('success', 'O Utilizador foi Eliminado com Sucesso!');

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

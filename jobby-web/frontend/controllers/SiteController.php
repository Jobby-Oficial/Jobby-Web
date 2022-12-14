<?php

namespace frontend\controllers;

use common\models\Avaliation;
use common\models\Service;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Favorite;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            /*'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],*/
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {

            $name = $exception->getName() . " (#" . $exception->statusCode . ")";
            $message = $exception->getMessage();

            if($exception->statusCode == 404){
                return $this->render('404', ['exception' => $exception, 'message' => $message, 'name' => $name]);
            }
            else if($exception->statusCode == 403){
                return $this->render('403', ['exception' => $exception, 'message' => $message, 'name' => $name]);
            }
            else{
                return $this->render('error', ['exception' => $exception, 'message' => $message, 'name' => $name]);
            }
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Obrigado por se ter Registado!!!');
            return $this->redirect(['/login']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    /**
     * Displays privacy.
     *
     * @return mixed
     */
    public function actionPrivacy()
    {
        return $this->render('privacy');
    }

    /**
     * Displays terms.
     *
     * @return mixed
     */
    public function actionTerms()
    {
        return $this->render('terms');
    }

    /**
     * Displays Suporte.
     *
     * @return mixed
     */
    public function actionSupport()
    {
        if ($this->request->isPost) {
            Yii::$app->mailer->compose()
                ->setFrom([$this->request->post()['email']])
                ->setTo(['jobby.info@gmail.com'])
                ->setSubject($this->request->post()['assunto'])
                ->setTextBody($this->request->post()['mensagem'])
                ->send();

            \Yii::$app->session->setFlash('success', 'Mensagem enviada com sucesso!');
        }

        return $this->render('support');
    }

    /**
     * Displays Favorite.
     *
     * @return mixed
     */
    public function actionCreateFavorite()
    {
        $model = new Favorite();

        $model->service_id = $this->request->post()['service_id'];
        $model->user_id = $this->request->post()['user_id'];
        $model->validate();
        $model->save();
    }

    /**
     * Displays Favorite.
     *
     * @return mixed
     */
    public function actionDeleteFavorite($id)
    {
        $model = Favorite::find()->where(['id' => $id])->one();
        $model->delete();
    }

    /**
     * Displays Avaliation.
     *
     * @return mixed
     */
    public function actionCreateAvaliation()
    {
        $model = new Avaliation();

        $model->avaliation = $this->request->post()['avaliation'];
        $model->service_id = $this->request->post()['service_id'];
        $model->user_id = $this->request->post()['user_id'];
        $model->validate();
        $model->save();
        $this->actionRatingAvaliation($model->service_id);
    }

    /**
     * Displays Avaliation.
     *
     * @return mixed
     */
    public function actionUpdateAvaliation($id)
    {
        $model = Avaliation::find()->where(['id' => $id])->one();

        $model->avaliation = $this->request->post()['avaliation'];
        $model->validate();
        $model->save();
        $this->actionRatingAvaliation($this->request->post()['service_id']);
    }

    /**
     * Displays Avaliation.
     *
     * @return mixed
     */
    public function actionDeleteAvaliation($id)
    {
        $model = Avaliation::find()->where(['id' => $id])->one();
        $model->delete();
        $this->actionRatingAvaliation($this->request->post()['service_id']);
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
}

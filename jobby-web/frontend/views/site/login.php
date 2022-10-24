<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/login.css');
?>

<section class="background-login">

    <div class="login-box">
        <h2>Bem-vindo de volta!</h2><br>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username', ['class' => 'login-label']) ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Password', ['class' => 'login-label']) ?>

        <div class="flex-grid-center login-btn">
            <?= Html::submitButton('Entrar', ['class' => 'fuller-button white login-btn', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</section>





<!--<div class="site-login">
    <h1><?/*= Html::encode($this->title) */?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php /*$form = ActiveForm::begin(['id' => 'login-form']); */?>

                <?/*= $form->field($model, 'username')->textInput(['autofocus' => true]) */?>

                <?/*= $form->field($model, 'password')->passwordInput() */?>

                <?/*= $form->field($model, 'rememberMe')->checkbox() */?>

                <div class="my-1 mx-0" style="color:#999;">
                    If you forgot your password you can <?/*= Html::a('reset it', ['site/request-password-reset']) */?>.
                    <br>
                    Need new verification email? <?/*= Html::a('Resend', ['site/resend-verification-email']) */?>
                </div>

                <div class="form-group">
                    <?/*= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) */?>
                </div>

            <?php /*ActiveForm::end(); */?>
        </div>
    </div>
</div>-->
<!--<section class="background-login">

<div class="login-box">
    <h2>Bem-vindo de volta!</h2><br>
    <form>
        <div class="user-box">
            <input type="text" name="" required="">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="" required="">
            <label>Password</label>
        </div>
        <div class="flex-grid-center login-btn">
            <a href="#" class="fuller-button white login-btn">Entrar</a>
        </div>
        <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Submit
        </a>
    </form>
</div>

</section>-->
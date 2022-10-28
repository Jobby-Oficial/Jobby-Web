<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';
$this->registerCssFile('@web/css/login.css');
?>

<!--<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?/*= Html::encode($this->title) */?></h1>

        <p>Please fill out the following fields to login:</p>

        <?php /*$form = ActiveForm::begin(['id' => 'login-form']); */?>

            <?/*= $form->field($model, 'username')->textInput(['autofocus' => true]) */?>

            <?/*= $form->field($model, 'password')->passwordInput() */?>

            <?/*= $form->field($model, 'rememberMe')->checkbox() */?>

            <div class="form-group">
                <?/*= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) */?>
            </div>

        <?php /*ActiveForm::end(); */?>
    </div>
</div>-->


<div class="container">
    <div class="logo"><img src="<?= Url::to('@web/assets/img/jobby_oficial_box_white.svg', true) ?>" width="340"/></div>
    <div class="login-item">

        <p>Preencha os seguintes campos para fazer o login:</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form form-login']]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password', )->passwordInput() ?>

        <div class="flex-grid-center login-btn">
            <?= Html::submitButton('Entrar', ['class' => 'fuller-button white login-btn', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>



<!--<script src="https://use.typekit.net/rjb4unc.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<div class="container">
    <div class="logo">Agent Q Dashboard</div>
    <div class="login-item">
        <form action="" method="post" class="form form-login">
            <div class="form-field">
                <label class="user" for="login-username"><span class="hidden">Username</span></label>
                <input id="login-username" type="text" class="form-input" placeholder="Username" required>
            </div>

            <div class="form-field">
                <label class="lock" for="login-password"><span class="hidden">Password</span></label>
                <input id="login-password" type="password" class="form-input" placeholder="Password" required>
            </div>

            <div class="form-field">
                <input type="submit" value="Log in">
            </div>
        </form>
    </div>
</div>-->



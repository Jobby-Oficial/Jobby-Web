<?php

/* @var yii\web\View $this */
/* @var yii\bootstrap5\ActiveForm $form */
/* @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use kartik\date\DatePicker;

$this->title = 'Registar';
// $this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/registerForm.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('https://kit.fontawesome.com/ea7160ad2a.js');
$this->registerCssFile('@web/css/signup.css');
?>


<section class="background-signup">
    <div class="site-signup signup-box">
        <h1 class="text-center">Criar uma Conta</h1>

        <p class="text-center">Insere os teus dados pessoais e começa a jornada connosco.<br>Preencha todos os campos para se Registar:</p>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="row">

            <div class="col">

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username', ['class' => 'signup-label']) ?>

        <?= $form->field($model, 'email')->label('Email', ['class' => 'signup-label']) ?>

        <?= $form->field($model, 'name')->textInput()->label('Nome', ['class' => 'signup-label']) ?>

        <?= $form->field($model, 'phone')->textInput(['type' => 'number'])->label('Telemóvel', ['class' => 'signup-label']) ?>

            </div>

            <div class="col">

        <?= $form->field($model, 'genre')->dropdownList(['m' => 'Masculino', 'f' => 'Feminino', 'o' => 'Outro'])->label('Género', ['class' => 'signup-label']) ?>

        <?= $form->field($model, 'birth')->widget(DatePicker::className(), ['name' => 'birth',
            'value' => date('Y-m-d'),
            'options' => ['placeholder' => 'Selecione a sua Data de Nascimento'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]])->label('Data de Nascimento', ['class' => 'signup-label']); ?>

        <?= $form->field($model, 'country')->dropdownList([])->label('País', ['class' => 'signup-label']) ?>

        <?= $form->field($model, 'city')->dropdownList([])->label('Cidade', ['class' => 'signup-label']) ?>

            </div>

            <div class="col">

        <?= $form->field($model, 'morada')->textInput()->label('Morada', ['class' => 'signup-label']) ?>

        <?= $form->field($model, 'typeUser')->dropdownList(['consumer' => 'Cliente', 'professional' => 'Profissional'])->label('Tipo de Utilizador', ['class' => 'signup-label']) ?>

        <?= $form->field($model, 'biography')->textarea(['class' => 'textarea'])->label('Biografia', ['class' => 'signup-label']) ?>

            </div>

        </div>


        <div class="row">

            <div class="col">

        <?= $form->field($model, 'password_hash')->passwordInput()->label('Palavra-passe', ['class' => 'signup-label']) ?>

            </div>

            <div class="col">

        <?= $form->field($model, 'password_repeat')->passwordInput()->label('Confirmar Palavra-passe', ['class' => 'signup-label']) ?>

            </div>

        </div>

        <div class="form-group flex-grid-center signup-btn">
            <?= Html::submitButton('Registar', ['class' => 'fuller-button white signup-btn w-100', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</section>










<!--
<div class="site-signup">
    <h1><?/*= Html::encode($this->title) */?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php /*$form = ActiveForm::begin(['id' => 'form-signup']); */?>

                <?/*= $form->field($model, 'username')->textInput(['autofocus' => true]) */?>

                <?/*= $form->field($model, 'email') */?>

                <?/*= $form->field($model, 'password')->passwordInput() */?>

                <div class="form-group">
                    <?/*= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) */?>
                </div>

            <?php /*ActiveForm::end(); */?>
        </div>
    </div>
</div>-->

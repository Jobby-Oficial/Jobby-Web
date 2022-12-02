<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JqueryAsset;

$this->title = "Atualizar Perfil";

$this->registerJsFile('@web/js/updateProfile.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('https://kit.fontawesome.com/ea7160ad2a.js');
?>

<div class="site-signup mt-5">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <br>
    <br>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <!-- <?php $form->field($model, 'image')->fileInput(['accept' => 'image/*']) ?> -->

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username') ?>

            <?= $form->field($model, 'email')->label('Email') ?>

            <?= $form->field($model, 'name')->textInput()->label('Nome') ?>

            <?= $form->field($model, 'phone')->textInput(['type' => 'number'])->label('Telemóvel') ?>

            <?= $form->field($model, 'genre')->dropdownList(['m' => 'Masculino', 'f' => 'Feminino', 'o' => 'Outro'])->label('Género') ?>

            <?= $form->field($model, 'birth')->widget(DatePicker::className(), ['name' => 'birth',
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Selecione a sua Data de Nascimento'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]]); ?>

            <?= $form->field($model, 'country')->dropdownList([])->label('País') ?>

            <?= $form->field($model, 'city')->dropdownList([])->label('Cidade') ?>

            <?= $form->field($model, 'morada')->textInput()->label('Morada') ?>

            <?php if(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id) == 'consumer' || \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id) == 'professional'){ ?>

                <?= $form->field($model, 'typeUser')->dropdownList(['consumer' => 'Cliente', 'professional' => 'Profissional'])->label('Tipo de Utilizador') ?>

            <?php }else{ ?>

                <?php foreach(\Yii::$app->authManager->getRolesByUser($model->id) as $role){ ?>

                    <?= $form->field($model, 'typeUser')->hiddenInput(['value' => $role->name])->label(false) ?>

                <?php } ?>

            <?php } ?>

            <?= $form->field($model, 'biography')->textarea()->label('Biografia') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Palavra-passe') ?>

            <?= $form->field($model, 'password_repeat')->passwordInput()->label('Confirmar Palavra-passe') ?>

            <div class="form-group">
                <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary w-100', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
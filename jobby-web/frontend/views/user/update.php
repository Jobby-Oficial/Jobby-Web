<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JqueryAsset;

$this->title = "Atualizar Perfil";

$this->registerCssFile('@web/css/userUpdate.css');
$this->registerJsFile('@web/js/updateProfile.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('https://kit.fontawesome.com/ea7160ad2a.js');

$role = '';
$userAssigned = Yii::$app->authManager->getAssignments(\Yii::$app->user->identity->id);
foreach($userAssigned as $userAssign){
    $role = $userAssign->roleName;
}
//dd($role);
?>

<section class="background-user-update">

    <div class="user-update-box">

        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="row">

            <div class="col">

                <!-- <?php $form->field($model, 'image')->fileInput(['accept' => 'image/*']) ?> -->

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username', ['class' => 'user-update-label']) ?>

                <?= $form->field($model, 'email')->label('Email', ['class' => 'user-update-label']) ?>

                <?= $form->field($model, 'name')->textInput()->label('Nome', ['class' => 'user-update-label']) ?>

                <?= $form->field($model, 'phone')->textInput(['type' => 'number'])->label('Telemóvel', ['class' => 'user-update-label']) ?>

            </div>

            <div class="col">

                <?= $form->field($model, 'genre')->dropdownList(['m' => 'Masculino', 'f' => 'Feminino', 'o' => 'Outro'])->label('Género', ['class' => 'user-update-label']) ?>

                <?= $form->field($model, 'birth')->widget(DatePicker::className(), ['name' => 'birth',
                    'value' => date('Y-m-d'),
                    'options' => ['placeholder' => 'Selecione a sua Data de Nascimento'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]])->label('Data de Nascimento', ['class' => 'user-update-label']); ?>

                <?= $form->field($model, 'country')->dropdownList([])->label('País', ['class' => 'user-update-label']) ?>

                <?= $form->field($model, 'city')->dropdownList([])->label('Cidade', ['class' => 'user-update-label']) ?>

            </div>

            <div class="col">
                <?php //dd(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id)['professional']->name == 'professional'); ?>
                <?= $form->field($model, 'morada')->textInput()->label('Morada', ['class' => 'user-update-label']) ?>

                <?php if($role == 'consumer' || $role == 'professional'){ ?>

                    <?= $form->field($model, 'typeUser')->dropdownList(['consumer' => 'Cliente', 'professional' => 'Profissional'])->label('Tipo de Utilizador', ['class' => 'user-update-label']) ?>

                    <?= $form->field($model, 'biography')->textarea(['class' => 'text-area-one'])->label('Biografia', ['class' => 'user-update-label']) ?>

                <?php } else { ?>

                    <?php foreach(\Yii::$app->authManager->getRolesByUser($model->id) as $role){ ?>

                        <?= $form->field($model, 'typeUser')->hiddenInput(['value' => $role->name])->label(false) ?>

                    <?php } ?>

                    <?= $form->field($model, 'biography')->textarea(['class' => 'text-area-two'])->label('Biografia', ['class' => 'user-update-label']) ?>

                <?php } ?>

            </div>

        </div>

        <div class="row">

            <div class="col">

                <?= $form->field($model, 'password')->passwordInput()->label('Palavra-passe', ['class' => 'user-update-label']) ?>

            </div>

            <div class="col">

                <?= $form->field($model, 'password_repeat')->passwordInput()->label('Confirmar Palavra-passe', ['class' => 'user-update-label']) ?>

            </div>

        </div>

        <div class="flex-grid-center user-update-btn">
            <?= Html::submitButton('Atualizar', ['class' => 'fuller-button white user-update-btn w-100', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</section>
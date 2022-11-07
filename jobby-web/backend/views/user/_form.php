<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile('@web/js/registerForm.js', ['depends' => [JqueryAsset::class]]);

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!-- <?php $form->field($model, 'image')->fileInput(['accept' => 'image/*']) ?> -->

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'genre')->dropdownList(['m' => 'Masculino', 'f' => 'Feminino', 'o' => 'Outro']) ?>

    <?= $form->field($model, 'birth')->widget(DatePicker::className(), ['name' => 'birth',
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Selecione a sua Data de Nascimento'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]]); ?>

    <?= $form->field($model, 'country')->dropdownList([]) ?>

    <?= $form->field($model, 'city')->dropdownList([]) ?>

    <?= $form->field($model, 'morada')->textInput() ?>

    <?= $form->field($model, 'typeUser')->dropdownList(['admin' => 'Admin', 'developer' => 'Developer', 'marketeer' => 'Marketeer'])->label('Tipo de Utilizador') ?>

    <?= $form->field($model, 'status')->textInput(['type' => 'number', 'min' => 0]) ?>

    <?= $form->field($model, 'plan_id')->dropdownList($plans, []) ?>

    <?= $form->field($model, 'biography')->textarea() ?>

    <?= $form->field($model, 'password')->passwordInput()->label('Palavra-passe') ?>

    <?= $form->field($model, 'password_repeat')->passwordInput()->label('Confirmar Palavra-passe') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

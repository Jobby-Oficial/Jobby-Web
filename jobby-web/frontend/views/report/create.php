<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use kartik\money\MaskMoney;

$this->title = 'Criar Denúncia';

$this->registerCssFile('@web/css/reportCreate.css');
?>

<section class="background-report-create">

    <div class="report-create-box">

        <h2><?= Html::encode($this->title) ?></h2><br>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nome', ['class' => 'report-create-label']) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Descrição', ['class' => 'report-create-label']) ?>

        <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user])->label(false) ?>

        <div class="flex-grid-center report-create-btn">
            <?= Html::submitButton('Criar Denúncia', ['class' => 'fuller-button white report-create-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</section>
<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use kartik\money\MaskMoney;

$this->title = 'Criar Denúncia';

?>

<section class="container mt-5">
    <div class="site-signup">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'user_id')->dropDownList($users, []) ?>

                <div class="form-group">
                    <?= Html::submitButton('Criar Denúncia', ['class' => 'btn btn-primary w-100']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
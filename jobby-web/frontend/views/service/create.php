<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use kartik\money\MaskMoney;

$this->title = 'Criar Serviço';

$this->registerJsFile('@web/js/getCategory.js', ['depends' => [JqueryAsset::class]]);
?>

<section class="container mt-5">
    <div class="site-signup">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'price')->widget(MaskMoney::className(), ['name' => 'price',
                    'pluginOptions' => [
                        'prefix' => '€',
                        'decimal' => '.',
                        'thousands' => ',',
                        'precision' => 2,
                    ],
                ]) ?>

                <?= $form->field($model, 'category')->dropDownList([]) ?>

                <?= $form->field($modelServiceGallery, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

                <?= $form->field($model, 'user_id')->hiddenInput(['value' => \Yii::$app->user->identity->id])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('Criar Serviço', ['class' => 'btn btn-primary w-100']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
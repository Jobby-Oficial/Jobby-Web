<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use kartik\money\MaskMoney;

$this->title = 'Criar Serviço';

$this->registerCssFile('@web/css/serviceCreate.css');
$this->registerJsFile('@web/js/getCategory.js', ['depends' => [JqueryAsset::class]]);
?>

<section class="background-service-create">

    <div class="service-create-box">
        <h2><?= Html::encode($this->title) ?></h2><br>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nome', ['class' => 'service-create-label']) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Descrição', ['class' => 'service-create-label']) ?>

        <?= $form->field($model, 'price')->widget(MaskMoney::className(), ['name' => 'price',
            'pluginOptions' => [
                'prefix' => '€',
                'decimal' => '.',
                'thousands' => ',',
                'precision' => 2,
            ],
        ])->label('Preço', ['class' => 'service-create-label']) ?>

        <?= $form->field($model, 'category',)->dropDownList([])->label('Categoria', ['class' => 'service-create-label']) ?>

        <?= $form->field($modelServiceGallery, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Imagem', ['class' => 'service-create-label']) ?>

        <?= $form->field($model, 'user_id')->hiddenInput(['value' => \Yii::$app->user->identity->id])->label(false) ?>

        <div class="flex-grid-center service-create-btn">
            <?= Html::submitButton('Criar Serviço', ['class' => 'fuller-button white service-create-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</section>
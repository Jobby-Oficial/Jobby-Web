<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/** @var yii\web\View $this */
/** @var common\models\Plan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-form">

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

    <?= $form->field($model, 'num_service')->textInput(['type' => 'number', 'min' => 0]) ?>

    <?= $form->field($model, 'num_highlight')->textInput(['type' => 'number', 'min' => 0]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

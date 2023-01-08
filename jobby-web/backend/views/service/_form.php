<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;
use kartik\money\MaskMoney;

/** @var yii\web\View $this */
/** @var common\models\Service $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile('@web/js/getCategory.js', ['depends' => [JqueryAsset::class]]);

?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label("Nome") ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label("Descrição") ?>

    <?= $form->field($model, 'price')->widget(MaskMoney::className(), ['name' => 'price',
        'pluginOptions' => [
            'prefix' => '€',
            'decimal' => '.',
            'thousands' => ',',
            'precision' => 2,
        ],
    ]) ?>

    <?php if (isset($model->rating_average)){ ?>

        <?= $form->field($model, 'rating_average')->hiddenInput(['value' => $model->rating_average])->label(false) ?>

    <?php } else { ?>

        <?= $form->field($model, 'rating_average')->hiddenInput(['value' => 0.0])->label(false) ?>

    <?php } ?>

    <?= $form->field($model, 'category')->dropDownList([])->label("Categoria") ?>

    <?= $form->field($model, 'user_id')->dropDownList($users, [])->label("Utilizador") ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

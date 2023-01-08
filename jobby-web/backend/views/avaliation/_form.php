<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/** @var yii\web\View $this */
/** @var common\models\Avaliation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="avaliation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'avaliation')->radioList( [0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'] ) ?>

    <?= $form->field($model, 'service_id')->dropDownList($services, []) ?>

    <?= $form->field($model, 'user_id')->dropDownList($users, []) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

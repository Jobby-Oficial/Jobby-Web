<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceSearch */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('@web/js/getCategorySearch.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('@web/js/getCountrySearch.js', ['depends' => [JqueryAsset::class]]);
?>

<section class="service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'class' => 'row service-form-search',
        ],
    ]); ?>

    <section class="col-xl-3">
        <?= $form->field($model, 'category')->dropDownList(['default' => 'Selecione uma Categoria']) ?>
    </section>
    <section class="col-xl-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </section>

    <!-- <?php echo $form->field($modelUser, 'country')->dropDownList(['default' => 'Selecione um País']) ?>

    <?php echo $form->field($modelUser, 'city')->dropDownList(['inputOptions' => ['placeholder' => 'Selecione um País para Desbloquear as Cidades']]) ?> -->

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'rating_average') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <section class="form-group col-xl-3 d-flex align-items-center mb-0 mt-3 justify-content-center">
        <?= Html::submitButton(Yii::t('app', 'Procurar'), ['class' => 'btns-list search']) ?>
        <?= Html::a(Yii::t('app', 'Reiniciar'), ['/services'], ['class' => 'btns-list reset']) ?>
    </section>

    <?php ActiveForm::end(); ?>

</section>

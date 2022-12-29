<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use kartik\money\MaskMoney;
use yii\widgets\Pjax;

$this->title = 'Atualizar Serviço';

$this->registerJsFile('@web/js/getCategory.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('@web/js/deleteGallery.js', ['depends' => [JqueryAsset::class]]);
?>

<section class="container">
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="profile-body-section p-2 mt-3">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-service-tab" data-bs-toggle="pill" data-bs-target="#pills-service" type="button" role="tab" aria-controls="pills-service" aria-selected="true">Serviço</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">Galeria</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <section class="mt-2">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div id="pills-service" role="tabpanel" aria-labelledby="pills-service-tab" class="site-signup tab-pane show active">
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

                                <?= $form->field($model, 'user_id')->hiddenInput(['value' => \Yii::$app->user->identity->id])->label(false) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Atualizar Serviço', ['class' => 'btn btn-primary w-100']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" class="tab-pane fade">
                        <?php if(isset($warning)){ ?>
                            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                                <strong><?= $warning ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <?php if($model->serviceGalleries != null){ ?>
                            <div class="row">
                                <?php Pjax::begin(['id' => 'service-gallery-id-wrap']); ?>
                                <?php foreach($model->serviceGalleries as $keyGallery => $gallery){ ?>
                                    <div class="col-xl-2">
                                        <img class="service-gallery-images" src="<?= $gallery->image ?>" alt="Service Gallery Image <?= $keyGallery ?>">
                                        <div class="d-flex justify-content-center mt-3">
                                            <?php if(count($model->serviceGalleries) > 1){ ?>
                                                <a href="#" class="btn btn-danger" onClick="deleteServiceGallery(<?= $model->id ?>, <?= $gallery->id ?>);">Apagar</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php Pjax::end(); ?>
                            </div>
                        <?php } ?>

                        <?php Pjax::begin(['id' => 'service-gallery-form-id-wrap']); ?>
                        <?php if(count($model->serviceGalleries) < 5){ ?>

                            <?php $form = ActiveForm::begin(['id' => 'service-gallery-form-id']); ?>

                            <?= $form->field($modelServiceGallery, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Atualizar Galeria', ['class' => 'btn btn-primary w-100']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        <?php } ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
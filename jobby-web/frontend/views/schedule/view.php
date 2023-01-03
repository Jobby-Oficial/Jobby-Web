<?php

use yii\web\JqueryAsset;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use kartik\money\MaskMoney;
use yii\widgets\Pjax;
use ruskid\stripe\StripeCheckout;

$this->registerCssFile('@web/css/scheduleView.css');
$this->registerJsFile('@web/js/scheduleView.js', ['depends' => [JqueryAsset::class]]);
?>

<section class="background-schedule-view">
    <section class="container">
        <div class="schedule-view-box">
            <section class="row">
                <section class="col-xl-10">
                    <div>
                        <h2><?= $model->service->name ?></h2>
                    </div>
                </section>
                <section class="col-xl-2 d-flex justify-content-center align-items-center">
                    <?php Pjax::begin(['id' => 'schedule-schedule_status-wrap']); ?>
                    <?php if($model->schedule_status == '1' && $model->jobStatus->name != 'Concluído'){ ?>
                        <div class="result-body-section d-flex justify-content-center">
                            <span class="schedule-status-badge-datail badge badge-success">ACEITE</span>
                        </div>
                    <?php } else if($model->schedule_status == '0'){ ?>
                        <div class="result-body-section d-flex justify-content-center">
                            <span class="schedule-status-badge-datail badge badge-danger">CANCELADO</span>
                        </div>
                    <?php } else if($model->jobStatus->name == 'Concluído'){ ?>
                        <div class="result-body-section d-flex justify-content-center">
                            <span class="schedule-status-badge-datail badge badge-success">CONCLUÍDO</span>
                        </div>
                    <?php } ?>
                    <?php Pjax::end(); ?>
                </section>
            </section>
<!--            <section class="row">-->
                <section class="col-xl-10">
                    <div class="d-flex">
                        <?php if($model->client->id != \Yii::$app->user->identity->id){ ?>
                            <!-- <img class="professional-img-profile-service-page mr-2" src="<?= $model->client->image ?>" alt="Client Image"> -->
                            <div class="mt-4 schedule-view-label"><strong>Cliente:&nbsp;</strong><?= $model->client->name ?></div>
                        <?php }else{ ?>
                            <!-- <img class="professional-img-profile-service-page mr-2" src="<?= $model->professional->image ?>" alt="Professional Image"> -->
                            <div class="mt-4 schedule-view-label"><strong>Profissional:&nbsp;</strong><?= $model->professional->name ?></div>
                        <?php } ?>
                    </div>
                    <div class="mt-2">
                        <div class="schedule-view-label"><strong>Data:&nbsp;</strong><?= $model->service_date ?> <?= $model->service_time ?></div>
                    </div>
                    <div class="mt-2 schedule-view-label"><strong>Preço:&nbsp;</strong><?= $model->price ?>€</div>
                    <div class="mt-2 schedule-view-label">
                        <div><strong>Nota:</strong></div>
                        <div class="text-justify overflow-hidden text-ellipsis text-break"><?= $model->note ?></div>
                    </div>
                </section>
        </div>
        <div class="profile-body-section">
                <section class="col-xl-12 d-flex justify-content-center">
                    <?php Pjax::begin(['id' => 'schedule-status_job-wrap']); ?>
                    <div>
                        <?php if($model->professional_id == \Yii::$app->user->identity->id && $model->jobStatus->name != 'Concluído' && $model->job_status_id != 1 && $model->schedule_status != '0'){ ?>
                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'job_status_id')->dropdownList($status)->label('Status do Serviço:', ['class' => 'schedule-status-badge-detail badge badge-secondary mb-2']); ?>
                            <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false) ?>

                            <?php ActiveForm::end(); ?>
                        <?php }else if($model->jobStatus->name != 'Concluído' && $model->schedule_status != '0'){ ?>
                            <div class="d-flex justify-content-end">
                                <span class="schedule-status-badge-detail badge badge-secondary"><?= $model->jobStatus->name ?></span>
                            </div>
                        <?php } ?>
                    </div>
                    <?php Pjax::end(); ?>
                </section>
<!--            </section>-->
            <section class="col-xl-12 d-flex justify-content-center">
                <?php Pjax::begin(['id' => 'schedule-schedule_status-buttons-wrap']); ?>
                <?php if($model->schedule_status == null && $model->schedule_status != '0' && $model->professional_id == \Yii::$app->user->identity->id && $model->jobStatus->name != 'Concluído'){ ?>

                    <?php Modal::begin([
                        'title' => 'Recusar Pedido',
                        'options' => [
                            'id' => 'modal-refuse-schedule',
                        ],
                        'toggleButton' => ['label' => 'Recusar', 'class' => 'btn btn-danger schedule-btn-recusar'],
                    ]) ?>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'schedule_status_note')->textarea(['rows' => 4]); ?>

                    <section class="d-flex justify-content-center">
                        <a href="#" class="schedule-refuse-button btn btn-danger" onClick="responseSchedule(<?= $model->id ?>, 0);">Recusar</a>
                    </section>

                    <?php ActiveForm::end(); ?>

                    <?php Modal::end();?>

                    <?php Modal::begin([
                    'title' => 'Aceitar Pedido',
                    'options' => [
                        'id' => 'modal-accept-schedule',
                    ],
                    'toggleButton' => ['label' => 'Aceitar', 'class' => 'btn btn-success ml-2'],
                ]) ?>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'price')->widget(MaskMoney::className(), ['name' => 'price',
                    'pluginOptions' => [
                        'prefix' => '€',
                        'decimal' => '.',
                        'thousands' => ',',
                        'precision' => 2,
                    ],
                ]) ?>

                    <section class="d-flex justify-content-center">
                        <a href="#" class="schedule-accept-button btn btn-success ml-2" onClick="responseSchedule(<?= $model->id ?>, 1);">Aceitar</a>
                    </section>

                    <?php ActiveForm::end(); ?>

                    <?php Modal::end();?>

                <?php } else if($model->schedule_status == '1' && $model->jobStatus->name != 'Concluído'){ ?>

                    <?php Modal::begin([
                        'title' => 'Cancelar Pedido',
                        'options' => [
                            'id' => 'modal-refuse-schedule',
                        ],
                        'toggleButton' => ['label' => 'Cancelar', 'class' => 'btn btn-danger'],
                    ]) ?>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'schedule_status_note')->textarea(['rows' => 6]); ?>

                    <section class="d-flex justify-content-center">
                        <a href="#" class="schedule-cancel-button btn btn-danger" onClick="responseSchedule(<?= $model->id ?>, 0);">Cancelar</a>
                    </section>

                    <?php ActiveForm::end(); ?>

                    <?php Modal::end();?>

                <?php } ?>

                <?php Pjax::end(); ?>
            </section>
        </div>
            <section class="row mt-5">
                <section class="col-xl-9 d-flex justify-content-end mt-5">
                    <?php if($model->payment == 0 && $model->jobStatus->name == 'Concluído' && $model->client_id == \Yii::$app->user->identity->id){ ?>
                        <?=
                        StripeCheckout::widget([
                            'action' => 'http://localhost/jobby-web/frontend/web/schedule/view?id=' . $model->id,
                            'name' => 'Pagar Serviço',
                            'description' => $model->service->name,
                            'amount' => bcmul($model->price, 100),
                            'image' => 'http://localhost/jobby-web/frontend/web/assets/img/payment.png'
                        ]);
                        ?>
                    <?php } ?>
                </section>
            </section>
    </section>
</section>
<?php

use yii\web\JqueryAsset;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use kartik\money\MaskMoney;
use yii\widgets\Pjax;
use ruskid\stripe\StripeCheckout;

$this->registerJsFile('@web/js/scheduleView.js', ['depends' => [JqueryAsset::class]]);
?>

<section class="container">
    <section class="row">
        <section class="col-xl-10">
            <div>
                <h1><?= $model->service->name ?></h1>
            </div>
        </section>
        <section class="col-xl-2 d-flex justify-content-center align-items-center">
            <?php Pjax::begin(['id' => 'schedule-schedule_status-wrap']); ?>
            <?php if($model->schedule_status == '1' && $model->jobStatus->name != 'Concluído'){ ?>
                <div>
                    <span class="schedule-status-badge badge badge-success">ACEITE</span>
                </div>
            <?php } else if($model->schedule_status == '0'){ ?>
                <div>
                    <span class="schedule-status-badge badge badge-danger">CANCELADO</span>
                </div>
            <?php } else if($model->jobStatus->name == 'Concluído'){ ?>
                <div>
                    <span class="schedule-status-badge badge badge-success">CONCLUÍDO</span>
                </div>
            <?php } ?>
            <?php Pjax::end(); ?>
        </section>
    </section>
    <section class="row">
        <section class="col-xl-10">
            <div class="d-flex">
                <?php if($model->client->id != \Yii::$app->user->identity->id){ ?>
                    <!-- <img class="professional-img-profile-service-page mr-2" src="<?= $model->client->image ?>" alt="Client Image"> -->
                    <div><?= $model->client->username ?></div>
                <?php }else{ ?>
                    <!-- <img class="professional-img-profile-service-page mr-2" src="<?= $model->professional->image ?>" alt="Professional Image"> -->
                    <div><?= $model->professional->username ?></div>
                <?php } ?>
            </div>
            <div class="mb-2 mt-3">
                <div><strong>Data: </strong><?= $model->service_date ?> <?= $model->service_time ?></div>
            </div>
            <div class="mt-1 mb-2"><strong>Preço: </strong><?= $model->price ?>€</div>
            <div>
                <div><strong>Nota: </strong></div>
                <div class="text-justify overflow-hidden text-ellipsis text-break"><?= $model->note ?></div>
            </div>
        </section>
        <section class="col-xl-2">
            <?php Pjax::begin(['id' => 'schedule-status_job-wrap']); ?>
            <div>
                <?php if($model->professional_id == \Yii::$app->user->identity->id && $model->jobStatus->name != 'Concluído' && $model->job_status_id != 1 && $model->schedule_status != '0'){ ?>
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'job_status_id')->dropdownList($status); ?>
                    <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false) ?>

                    <?php ActiveForm::end(); ?>
                <?php }else if($model->jobStatus->name != 'Concluído' && $model->schedule_status != '0'){ ?>
                    <div class="d-flex justify-content-center">
                        <span class="schedule-status-badge badge badge-secondary"><?= $model->jobStatus->name ?></span>
                    </div>
                <?php } ?>
            </div>
            <?php Pjax::end(); ?>
        </section>
    </section>
    <section class="col-xl-12 d-flex justify-content-end">
        <?php Pjax::begin(['id' => 'schedule-schedule_status-buttons-wrap']); ?>
        <?php if($model->schedule_status == null && $model->schedule_status != '0' && $model->professional_id == \Yii::$app->user->identity->id && $model->jobStatus->name != 'Concluído'){ ?>
            <?php Modal::begin([
                'title' => 'Recusar Pedido',
                'options' => [
                    'id' => 'modal-refuse-schedule',
                ],
                'toggleButton' => ['label' => 'Recusar', 'class' => 'btn btn-danger'],
            ]) ?>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'schedule_status_note')->textarea(['rows' => 6]); ?>

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
        <?php }else if($model->schedule_status == '1' && $model->jobStatus->name != 'Concluído'){ ?>
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
    <section class="row mt-5">
        <section class="col-xl-12 d-flex justify-content-center">
            <?php if($model->payment == 0 && $model->jobStatus->name == 'Concluído' && $model->client_id == \Yii::$app->user->identity->id){ ?>
                <?=
                StripeCheckout::widget([
                    'action' => '/schedule/view?id=' . $model->id,
                    'name' => 'Pagar Serviço',
                    'description' => $model->service->name,
                    'amount' => bcmul($model->price, 100),
                    'image' => 'http://localhost:20080/assets/img/payment.png'
                ]);
                ?>
            <?php } ?>
        </section>
    </section>
</section>
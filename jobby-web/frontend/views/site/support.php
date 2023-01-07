<?php

use yii\helpers\Html;

$this->registerCssFile('@web/css/submit.css');
$this->registerJsFile('@web/js/submit.js');

?>

<section class="contact align-items-center d-flex h-100 justify-content-center" id="contact">
    <div class="container">
        <?php /*if (\Yii::$app->session->hasFlash('success')){ */?><!--
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?/*= \Yii::$app->session->getFlash('success') */?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        --><?php /*} */?>
        <div class="heading text-center">
            <h2>Contacte-<span>nos</span></h2>
            <br>
            <br>
            <br>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                <br>incididunt ut labore et dolore magna aliqua.</p> -->
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="title">
                    <h3>Detalhes do Contacto</h3>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p> -->
                </div>
                <div class="content">
                    <!-- Info-1 -->
                    <div class="info">
                        <i class="fas fa-mobile-alt"></i>
                        <h4 class="d-inline-block">Telefone:
                            <br>
                            <span>+351 927 632 646</span></h4>
                    </div>
                    <!-- Info-2 -->
                    <div class="info">
                        <i class="far fa-envelope"></i>
                        <h4 class="d-inline-block">Email:
                            <br>
                            <span>jobby.info@gmail.com</span></h4>
                    </div>
                    <!-- Info-3 -->
                    <div class="info">
                        <i class="fas fa-map-marker-alt"></i>
                        <h4 class="d-inline-block">Morada:<br>
                            <span>Campus 2 - Morro do Lena, Alto do Vieiro, <br>Apt 4163, Edifício D, 2411-901 Leiria</span></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-7">

                <?= Html::beginForm(['site/support'], 'POST'); ?>

                <?= Html::input('Email', 'email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required'=>true]) ?>

                <?= Html::dropDownList('assunto', 'Pedido de Informação', ['Pedido de Informação' => 'Pedido de Informação', 'Bugs' => 'Bugs', 'Sugestões' => 'Sugestões', 'Outro' => 'Outro'], ['class' => 'form-select', 'required'=>true]) ?>

                <?= Html::textarea('mensagem', null, ['class' => 'form-control', 'placeholder' => 'Mensagem', 'rows' => 6, 'required'=>true]) ?>

                <section class="form-group">
                    <button class="bubbly-button" name="contact-button" type="submit">Enviar Menssagem!</button>
                    <?php //<?= Html::submitButton('Enviar!', ['class' => 'btn btn-block', 'name' => 'contact-button']); ?>
                </section>

                <?= Html::endForm(); ?>
            </div>
        </div>
    </div>
</section>
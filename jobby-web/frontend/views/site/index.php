<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<div class="header">
    <div class="inner-header flex">
        <div class="intro-text">
            <div class="intro-lead-in"><?= Html::img('@web/assets/img/jobby_oficial_white_box_v4.svg', ['alt' => 'Logo', 'class' => 'img-fit']);?></div>
            <div class="intro-heading">Encontra o serviço que procuras</div>
            <div class="flex-grid-center">
                <a href="#" class="fuller-button white">Explorar Serviços</a>
            </div>
        </div>
    </div>

    <!--Waves Container-->
    <div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>
    </div>
    <!--Waves end-->
</div>

<div class="container">

    <section class="presentation-section">
        <div class="container">
            <br>
            <a name="presentation" id="presentation"><h1 class="text-center">Melhor Site de Serviços do Mundo!</h1></a><br><hr><br><br>
            <div class="row">
                <div class="col-sm-7 presentation-box">
                    <h4>O melhor site de fornecimento de serviços do mercado! Tenha tudo na ponta dos dedos para
                        criar o seu anúncio. <br><br>Publici-te e usufrua com segurança todos os serviços disponíveis
                        e tenha sucesso com a JOBBY!</h4>
                </div>
                <div class="col-sm-5">
                    <span class=""><img src="<?= Url::to('@web/assets/img/Jobby_Mockup_2.png', true) ?>" class="presentation-radius" width="340" height="280" /></span>
                </div>
            </div>
        </div>
    </section>

    <div class="site-index">
        <div class="p-5 mb-4 bg-transparent rounded-3">
            <div class="container-fluid py-5 text-center">
                <h1 class="display-4">Congratulations!</h1>
                <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
                <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
            </div>
        </div>

        <?= Html::img('@web/assets/img/jobby_oficial_v4.svg', ['alt' => 'Logo', 'class' => 'img-fit test']);?>

        <div class="body-content">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                </div>
            </div>

        </div>
    </div>

</div>

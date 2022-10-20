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
                <span class="slideanim"><img src="<?= Url::to('@web/assets/img/Jobby_Mockup_2.png', true) ?>" class="presentation-radius" height="280" /></span>
            </div>
        </div>
    </div>
</section>

<section class="card-section">
    <div class="container">
        <a name="steps" id="steps"><h1 class="text-center">Descomplique em 3 passos</h1></a><br><hr><br><br>
        <div class="row">
            <div class="grid">
                <div class="card__box card__one">
                    <figure class="card__img">
                        <img src="<?= Url::to('@web/assets/img/card1.svg', true) ?>" width="340" height="280" />
                    </figure>
                    <div class="card__title">
                        <h4>Crie uma conta grátis</h4>
                    </div>
                    <div class="card__desc">
                        Crie uma conta grátis e procure ou crie serviços sem compromissos.
                    </div>
                </div>

                <div class="card__box card__one">
                    <figure class="card__img">
                        <img src="<?= Url::to('@web/assets/img/card2.svg', true) ?>" width="340" height="280" />
                    </figure>
                    <div class="card__title">
                        <h4>Procure serviços</h4>
                    </div>
                    <div class="card__desc">
                        Procure o serviço que precise e resolva os seus problemas em um click.
                    </div>
                </div>

                <div class="card__box card__one">
                    <figure class="card__img">
                        <img src="<?= Url::to('@web/assets/img/card3.svg', true) ?>" width="340" height="280" />
                    </figure>
                    <div class="card__title">
                        <h4>Agende o serviço</h4>
                    </div>
                    <div class="card__desc">
                        Agende o serviço, e o assunto está tratado. Fácil, rápido e simples. Como deve ser.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials-section">
    <div class="testimonials text-center">
        <div class="container">
            <a name="testimonials" id="testimonials"><h1 class="text-center">Testemunhos</h1></a><br><hr><br><br>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-light bg-light text-center">
                        <i class='bx bxs-quote-alt-right bx-tada card-img-top rounded-circle' aria-hidden="true"></i>
                        <div class="card-body blockquote">
                            <p class="card-text">Tínhamos um grande problema com a remodelação da nossa casa e graças à plataforma,
                                JOBBY, conseguimos arrnajar um profissional em menos de uma hora! A plataforma é bastante
                                direta e bem organizada o que nos facilita o acesso à procura de serviços!</p>
                            <br>
                            <footer class="blockquote-footer"><cite title="Source Title">Leonardo Ferreira</cite></footer>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-light bg-light text-center">
                        <i class='bx bxs-quote-alt-right bx-tada card-img-top rounded-circle' aria-hidden="true"></i>
                        <div class="card-body blockquote">
                            <p class="card-text">Os serviços que aparecem na plataforma são bastante recomendados, para mais que
                                estão muito explícitos e organizados, com isto consegui arranjar um ótimo profissional para me arrnjar
                                a construir a minha piscina no meu quintal de casa. JOBBY sem dúvida que facilita a vida das pessoas!</p>
                            <br>
                            <footer class="blockquote-footer"><cite title="Source Title">Daniela Ribeiro</cite></footer>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-light bg-light text-center">
                        <i class='bx bxs-quote-alt-right bx-tada card-img-top rounded-circle' aria-hidden="true"></i>
                        <div class="card-body blockquote">
                            <p class="card-text">Com a plataforma JOBBY, a minha vida tornou-se mais fácil. Consigo arranjar
                                qualquer tipo de serviço em muito pouco tempo! Recomendo a todos esta plataforma,
                                vão ver que irão poupar bastante tempo. É muito útil e eficaz!</p>
                            <br>
                            <footer class="blockquote-footer"><cite title="Source Title">Luís Soares</cite></footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="software-section">
    <div class="container">
        <a name="software" id="software"><h1 class="text-center">Plataforma JOBBY</h1></a><br><hr><br><br>
        <div class="row">
            <div class="col-sm-5">
                <span class="slideanim"><img src="<?= Url::to('@web/assets/img/Jobby_Mockup_1.png', true) ?>" class="software-radius" height="360" /></span>
            </div>
            <div class="col-sm-7 software-box">
                <h4>Quer poupar tempo e dinheiro, mantendo ao mesmo tempo um serviço eficiente e realizado por profissionais? Conheça a plataforma de fornecimento de
                    serviços do JOBBY, a solução ideal para quem procura serviços de todas as dimensões:<br><br> Marketing Digital, Personal Trainers, Contabilistas, Web Designer e muito mais...</h4>
            </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <a name="about" id="about"><h1 class="text-center">Sobre Nós</h1></a><br><hr><br><br>
        <div class="row">
            <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                <div class="inner-column">
                    <div class="sec-title">
                        <span class="title">------------------------</span>
                        <h2>Somos Líderes no <br> Mercado de Serviços <br> Desde 2022</h2>
                    </div>
                    <div class="text">Apesar de só existir no mercado desde 2022, conhecida como JOBBY,
                        a qualidade, caraterísticas inovadoras e os elevados padrões de performance fazem
                        com que atualmente a nossa plataforma seja conhecida e reconhecida por clientes, parceiros
                        e concorrentes como líder no segmento de Serviços online em Portugal.</div>
                    <ul class="list-style-one">
                        <li><i class='bx bxs-chevrons-right bx-tada' ></i><span>Simples</span></li>
                        <li><i class='bx bxs-chevrons-right bx-tada' ></i><span>Seguro</span></li>
                        <li><i class='bx bxs-chevrons-right bx-tada' ></i><span>Acessível</span></li>
                    </ul>
                </div>
            </div>

            <!-- Image Column -->
            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column wow fadeInLeft">
                    <figure class="image-1"><img src="<?= Url::to('@web/assets/img/Jobby_Mockup_3.png', true) ?>" alt=""></figure>
                    <figure class="image-2"><img src="<?= Url::to('@web/assets/img/Jobby_Mockup_4.png', true) ?>" alt=""></figure>
                </div>
            </div>
        </div>
    </div>
</section>





<!--
<div class="container">

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

-->
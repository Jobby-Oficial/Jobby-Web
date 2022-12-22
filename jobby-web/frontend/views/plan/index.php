<?php
/** @var yii\web\View $this */
use yii\bootstrap5\BootstrapAsset;
use \yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile("@web/css/plan.css", ['depends' => [BootstrapAsset::class]]);
?>

<section class="plans-wrap align-items-center d-flex h-100 justify-content-center">
    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Planos</h1>
        </div>
        <section class="mb-5">
            <div class="plans-text-font-size">O Jobby oferece vários planos para satisfazer as suas necessidades. O plano que escolher irá determinar o número de serviços que poderá criar ou destacar.</div>
            <br>
            <div class="plans-text-font-size">Pode explorar os diversos serviços, em qualquer um dos planos.</div>
        </section>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="price-table">
                    <div class="price-head">
                        <h4>Basic</h4>
                        <h2>Free/mês</h2>
                    </div>
                    <div class="price-content">
                        <ul>
                            <li>2 Serviços</li>
                            <li>Sem destaque</li>
                            <li>Favoritos</li>
                            <li>Suporte</li>
                        </ul>
                    </div>
                    <div class="price-button">
                        <a href="#">Obter Plano</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="price-table">
                    <div class="price-head">
                        <h4>Pro</h4>
                        <h2>5€/mês</h2>
                    </div>
                    <div class="price-content">
                        <ul>
                            <li>4 Serviços</li>
                            <li>2 Destaques (semanal)</li>
                            <li>Favoritos</li>
                            <li>Suporte</li>
                        </ul>
                    </div>
                    <div class="price-button">
                        <a href="#">Obter Plano</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="price-table">
                    <div class="price-head">
                        <h4>Ultimate</h4>
                        <h2>10€/mês</h2>
                    </div>
                    <div class="price-content">
                        <ul>
                            <li>Serviços Ilimitados</li>
                            <li>4 Destaques (semanal)</li>
                            <li>Favoritos</li>
                            <li>Suporte</li>
                        </ul>
                    </div>
                    <div class="price-button">
                        <a href="#">Obter Plano</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="mt-5">
            <div class="plans-text-font-size">Registe-se no Jobby hoje mesmo. Como membro do Jobby, o serviço ser-lhe-á automaticamente cobrado todos os meses, na mesma data em que se registou. Pode alterar o seu plano ou cancelar o serviço online quando quiser.</div>
        </section>
    </div>
</section>

<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\helpers\Url;

/* @var $service common\models\Service */

$this->registerCssFile('@web/css/serviceList.css');
$this->registerJsFile('@web/js/favorite.js', ['depends' => [JqueryAsset::class]]);
?>

<div class="eventWrapper">
    <div class="event">
        <div class="event--img">
            <a href="" onclick="if (!lightboxLoaded) return false" class="a-list w-fancybox">
                <img src="https://explicacoesdobairro.pt/wp-content/uploads/2019/07/logo-EB.png" title="" alt="">
            </a>
        </div>
        <div class="event--date">
            <span>Classificação</span>
            <span>4.9</span>
            <span><img src="<?php echo Yii::getAlias('@web') . '/assets/img/star-list.svg' ?>" alt="Star Icon"></span>
            <span>126 Avaliações</span>
        </div>
        <div class="event--content">
            <h2 class="h2-list"><a class="a-list" href="<?=Url::toRoute(['service/view/', 'id' => $service->id]);?>"><?= Html::encode($service->name) ?></a></h2>
            <p class="event--content-hall">
                <span class=""><strong>Profissional: </strong><span class="profissional"></span><a class="a-list" href="<?= Url::to(['user/view/', 'id' => $service->user_id]); ?>"><?= $service->user->name ?></a></span>
            </p>
            <div class="event--content-info">
                <!--<div><time>20:00 - 22:00</time></div>-->
                <div><span class=""><strong>Localidade: </strong><span class="localidade"></span>Portugal</span></div>
                <div class="event--content-price"><strong>Preço: </strong>12<span class="preco"></span></div>
                <div class="event--content-tickets"><a class="a-list" href="#" target="" title="">Agendar</a></div>
            </div>
            <p class="event--content-ensemble"><strong>Número de Telemóvel: </strong><?= $service->user->phone ?><span class="phone"></span></p>
            <p class="event--content-program"><a class="a-list" href="" target="" title=""><strong>Categoria: </strong><span class=""><?= Html::encode($service->category) ?></span></a></p>
        </div>
    </div>
</div>









<!--<section class="home-services-body-wrap row mt-4 pb-3">
    <section class="col-lg-2 d-flex align-items-center">
        <section class="w-100">
            <div class="d-flex justify-content-center">
                <h3>4.1</h3>
                <div class="ml-2"><img class="home-services-star-svg align-text-top" src="<?php /*echo Yii::getAlias('@web') . '/assets/img/star.svg' */?>" alt="Star Icon"></div>
            </div>
            <div class="mt-n3 text-center">
                <small class="home-service-avaliation">126 Avaliações</small>
            </div>
        </section>
    </section>
    <section class="col-lg-10">
        <section>
            <section class="home-services-paid-wrap float-right">
                <div class="home-services-paid text-right pl-4 pr-4">Anúncio</div>
            </section>
            <section class="d-flex w-100">
                <section class="service-info-wrap w-100 d-flex">
                    <div class="mt-3">
                        <strong><a href="<?/*=Url::toRoute(['service/view/', 'id' => $service->id]);*/?>"><?/*= Html::encode($service->name) */?></a></strong> | <strong>Profissional: </strong><span class="service-info"><a href="<?/*= Url::to(['user/view/', 'id' => $service->user_id]); */?>"><?/*= $service->user->username */?></a></span> | <strong>Categoria: </strong><?/*= Html::encode($service->category) */?>
                    </div>
                </section>
            </section>
            <div class="home-services-description mt-3 text-justify overflow-hidden text-ellipsis text-break"><?/*= Html::encode($service->description) */?></div>
            <div class="d-flex justify-content-end mt-3">
                <?php /*if(!\Yii::$app->user->isGuest){ */?>
                    <?php /*if(\Yii::$app->user->identity->id != $service->user->id){  */?>
                        <?php /*if($service->favorites != null){ */?>
                            <?php /*foreach($service->favorites as $favorite){ */?>
                                <?php /*if($favorite->service_id == $service->id && $favorite->user_id == \Yii::$app->user->identity->id){ */?>
                                    <img class="home-services-favorite-heart-favorite-svg align-text-top ml-1" onclick="deleteFavorite(<?/*= HTML::encode($favorite->id); */?>);" src="<?php /*echo Yii::getAlias('@web') . '/assets/img/heart-favorite.svg' */?>" alt="Heart Favorite Icon">
                                <?php /*}else{ */?>
                                    <img class="home-services-favorite-heart-svg align-text-top ml-1" onclick="createFavorite(<?/*= HTML::encode($service->id); */?>, <?/*= HTML::encode(\Yii::$app->user->identity->id); */?>);" src="<?php /*echo Yii::getAlias('@web') . '/assets/img/heart.svg' */?>" alt="Heart Icon">
                                <?php /*} */?>
                            <?php /*} */?>
                        <?php /*}else{ */?>
                            <img class="home-services-favorite-heart-svg align-text-top ml-1" onclick="createFavorite(<?/*= HTML::encode($service->id); */?>, <?/*= HTML::encode(\Yii::$app->user->identity->id); */?>);" src="<?php /*echo Yii::getAlias('@web') . '/assets/img/heart.svg' */?>" alt="Heart Icon">
                        <?php /*} */?>
                    <?php /*} */?>
                <?php /*} */?>
            </div>
        </section>
    </section>
</section>-->

<script src="https://kit.fontawesome.com/c7267aa8a6.js"></script>
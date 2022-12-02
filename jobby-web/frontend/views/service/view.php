<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\web\JqueryAsset;
use kartik\date\DatePicker;
use yii\bootstrap5\Modal;
use kartik\time\TimePicker;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;

$this->registerJsFile('@web/js/favorite.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('https://kit.fontawesome.com/ea7160ad2a.js');
?>

<section class="container professional-service-info-wrap">
    <?php if (\Yii::$app->session->hasFlash('success')){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= \Yii::$app->session->getFlash('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <section>
        <h1 class="text-center mt-3 mb-3">Detalhe do Serviço</h1>
    </section>
    <section class="row">
        <section class="professional-service-carousel-wrap col-xl-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php if($model->serviceGalleries != null){
                        foreach($model->serviceGalleries as $keyGallery => $gallery){ ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" <?php if($keyGallery == 0){?> class="active" <?php } ?>></li>
                        <?php }} ?>
                </ol>
                <div class="carousel-inner">
                    <?php if($model->serviceGalleries != null){
                        foreach($model->serviceGalleries as $keyGallery => $gallery){ ?>
                            <div class="carousel-item <?php if($keyGallery == 0){ ?> active <?php } ?>">
                                <img class="d-block w-100" src="<?= $gallery->image ?>" alt="First slide">
                            </div>
                        <?php }} ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>
        </section>
    </section>
    <section class="row">
        <section class="col-xl-8">
            <div class="mt-5">
                <h2><?= $model->name ?></h2>
            </div>
            <div class="mt-2">
                <div class="professional-service-page-wrap d-flex">
                    <div class="professional-img-profile-service-page-wrap professional-service-page-item d-flex">
                        <!-- <img class="professional-img-profile-service-page" src="<?= $model->user->image ?>" alt="Professional User Image"> -->
                        <a href="<?=Url::toRoute(['user/view/', 'id' => $model->user->id]);?>" class="service-professional-username ml-1"><?= $model->user->name ?></a><span class="professional-divisor-service-page ml-2 mr-2">|</span>
                    </div>
                    <div class=" professional-service-page-item"><strong>Categoria: </strong><?= $model->category ?></div><span class="professional-divisor-service-page ml-2 mr-2">|</span>
                    <div class="service-rating-star professional-service-page-item d-flex align-items-center">
                        <img class="mr-1" src="<?php echo Yii::getAlias('@web') . '/assets/img/star.svg' ?>" alt="Service Rating Star"> 5
                    </div><span class="professional-divisor-service-page ml-2 mr-2">|</span>
                    <?php Pjax::begin(['id' => 'favorite-service-view-id-wrap']); ?>
                    <?php if(!\Yii::$app->user->isGuest){ ?>
                        <?php if(\Yii::$app->user->identity->id != $model->user->id){ ?>
                            <?php if($model->favorites != null){ ?>
                                <?php foreach($model->favorites as $favorite){ ?>
                                    <?php if($favorite->service_id == $model->id && $favorite->user_id == \Yii::$app->user->identity->id){ ?>
                                        <img class="home-services-favorite-heart-favorite-svg align-text-top ml-1" onclick="deleteFavoriteServiceView(<?= HTML::encode($favorite->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart-favorite.svg' ?>" alt="Heart Favorite Icon">
                                    <?php }else{ ?>
                                        <img class="home-services-favorite-heart-svg align-text-top ml-1" onclick="createFavoriteServiceView(<?= HTML::encode($model->id); ?>, <?= HTML::encode(\Yii::$app->user->identity->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart.svg' ?>" alt="Heart Icon">
                                    <?php } ?>
                                <?php } ?>
                            <?php }else{ ?>
                                <img class="home-services-favorite-heart-svg align-text-top ml-1" onclick="createFavoriteServiceView(<?= HTML::encode($model->id); ?>, <?= HTML::encode(\Yii::$app->user->identity->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart.svg' ?>" alt="Heart Icon">
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
            <div class="mt-3">
                <div><strong>Descrição:</strong></div>
                <div class="mt-2 text-break">
                    <?= $model->description ?>
                </div>
            </div>
        </section>
        <section class="col-xl-4">
            <div class="professional-service-order-box mt-5">
                <div class="d-flex">
                    <div><strong>Preço:</strong></div>
                    <div class="w-100 text-right"><?= $model->price ?>€</div>
                </div>
                <div class="professional-service-order-box-warning mt-1">*Preço Base, pode haver alterações ao preço.</div>
                <div class="professional-service-order-box-button d-flex justify-content-center mt-4">
                    <?php if(!\Yii::$app->user->isGuest){ ?>
                        <?php Modal::begin([
                            'title' => 'Realizar Pedido',
                            'toggleButton' => ['label' => 'Realizar Pedido', 'class' => 'btn btn-primary'],
                        ]) ?>

                        <?php $form = ActiveForm::begin(['action' => ['schedule/create']]); ?>

                        <?= $form->field($modelSchedule, 'note')->textarea() ?>

                        <?= $form->field($modelSchedule, 'price')->hiddenInput(['value' => $model->price])->label(false) ?>

                        <?= $form->field($modelSchedule, 'service_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                        <?= $form->field($modelSchedule, 'service_date')->widget(DatePicker::classname(), ['name' => 'dp_5',
                            'type' => DatePicker::TYPE_INLINE,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'multidate' => false
                            ]]) ?>

                        <?= $form->field($modelSchedule, 'service_time')->widget(TimePicker::classname(), ['name' => 't1',
                            'pluginOptions' => [
                                'showSeconds' => false,
                                'showMeridian' => false,
                                'minuteStep' => 1
                            ]]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Agendar Serviço', ['class' => 'btn btn-primary w-100']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <?php Modal::end();?>
                    <?php } ?>
                </div>
            </div>
        </section>
    </section>
    <br>
    <br>
    <section class="row">
        <section class="col-xl-12">
            <?= edofre\fullcalendar\Fullcalendar::widget(['events' => $schedules, 'options' => [
                'id'       => 'calendar',
                'language' => 'pt',
            ],
                'clientOptions' => [
                    'weekNumbers' => false,
                    'selectable'  => true,
                ],
            ]); ?>
        </section>
    </section>
</section>
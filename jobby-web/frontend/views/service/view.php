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
use common\models\Avaliation;

$this->registerCssFile('@web/css/serviceDetail.css');
$this->registerJsFile('@web/js/favorite.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('https://kit.fontawesome.com/ea7160ad2a.js');
?>

<?php

$avaliations = Avaliation::find()->where(['service_id' => $model->id])->all();
$avaliationsCount = Avaliation::find()->where(['service_id' => $model->id])->count();

if ($avaliationsCount != 0) {
    $aux = 0;
    foreach ($avaliations as $avaliation) {
        $aux += $avaliation->avaliation;
    }
    $avaliations = ($aux / $avaliationsCount);
}
else {
    $avaliations = "0.0";
}

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
        <h1 class="text-center mt-5 mb-5">Detalhe do Serviço</h1>
    </section>
    <section class="row">
        <section class="professional-service-carousel-wrap col-xl-8">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if($model->serviceGalleries != null){
                        foreach($model->serviceGalleries as $keyGallery => $gallery){ ?>
                            <div class="carousel-item <?php if($keyGallery == 0){ ?> active <?php } ?>">
                                <img class="d-block w-100" src="<?= $gallery->image ?>" alt="First slide">
                            </div>
                        <?php }} ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>

            <div class="mt-5 mb-4">
                <h2><?= $model->name ?></h2>
            </div>

            <div class="chip">
                <div><strong>Descrição:</strong></div>
                <div class="mt-2 text-break">
                    <p><?= $model->description ?></p>
                </div>
            </div>
        </section>

        <section class="col-xl-4">
            <div class="professional-service-order-box">
                <div class="schedule-box">
                    <strong>Profissional:&nbsp;</strong><a class="a-list" href="<?= Url::to(['user/view/', 'id' => $model->user_id]); ?>"><?= $model->user->name ?></a>
                </div>
                <div class="mt-1 schedule-box">
                    <strong>Categoria:&nbsp;</strong><?= $model->category ?>
                </div>
                <div class="mt-1 schedule-box service-rating-star">
                    <strong>Classificação:&nbsp;</strong><?= $avaliations ?>
                    <img class="mr-1" src="<?php echo Yii::getAlias('@web') . '/assets/img/star-list.svg' ?>" alt="Service Rating Star">
                </div>
                <div class="mt-1 schedule-box">
                    <strong>Avaliações:&nbsp;</strong><?= $avaliationsCount ?>
                </div>
                <div class="mt-1 schedule-box">
                    <strong>Localização:&nbsp;</strong><?= $model->user->city ?>,&nbsp;<?= $model->user->country ?>
                </div>
                <div class="mt-1 schedule-box">
                    <strong>Número de Telemóvel: </strong><?= $model->user->phone ?>
                </div>
                <?php if(!\Yii::$app->user->isGuest){ ?>
                    <?php if(\Yii::$app->user->identity->id != $model->user->id){ ?>
                        <?php Pjax::begin(['id' => 'favorite-service-view-id-wrap']); ?>
                        <div class="mt-1 schedule-box">
                            <strong>Favorito:&nbsp;</strong>
                            <?php if($model->favorites != null){ ?>
                                <?php foreach($model->favorites as $favorite){ ?>
                                    <?php if($favorite->service_id == $model->id && $favorite->user_id == \Yii::$app->user->identity->id){ ?>
                                        <img class="home-services-favorite-heart-favorite-svg align-text-top" onclick="deleteFavoriteServiceView(<?= HTML::encode($favorite->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart-favorite.svg' ?>" alt="Heart Favorite Icon">
                                    <?php } else{ ?>
                                        <img class="home-services-favorite-heart-svg align-text-top" onclick="createFavoriteServiceView(<?= HTML::encode($model->id); ?>, <?= HTML::encode(\Yii::$app->user->identity->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart.svg' ?>" alt="Heart Icon">
                                    <?php } ?>
                                <?php } ?>
                            <?php } else{ ?>
                                <img class="home-services-favorite-heart-svg align-text-top" onclick="createFavoriteServiceView(<?= HTML::encode($model->id); ?>, <?= HTML::encode(\Yii::$app->user->identity->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart.svg' ?>" alt="Heart Icon">
                            <?php } ?>
                        </div>
                        <?php Pjax::end(); ?>
                    <?php } ?>
                <?php } ?>
                <hr class="mt-5">
                <div class="d-flex">
                    <div><strong>Preço:&nbsp;</strong></div>
                    <div class="w-100 text-right"><?= $model->price ?>€</div>
                </div>
                <div class="professional-service-order-box-warning mt-1">*Preço Base, pode haver alterações ao preço.</div>
                <div class="professional-service-order-box-button d-flex justify-content-center mt-4">
                    <?php if(!\Yii::$app->user->isGuest){ ?>
                        <?php Modal::begin([
                            'title' => 'Realizar Pedido',
                            'toggleButton' => ['label' => 'Realizar Pedido', 'class' => 'btns-list schedule'],
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
                            <?= Html::submitButton('Agendar Serviço', ['class' => 'btns-list schedule w-100']) ?>
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
    <section class="mt-5 mb-5 row">
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
    </section><br>
</section>
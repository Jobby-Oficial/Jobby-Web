<?php

use yii\bootstrap5\Html;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
use kartik\money\MaskMoney;

use yii\widgets\DetailView;

$this->registerCssFile('@web/css/profile.css');
$this->registerCssFile('@web/css/serviceList.css');
$this->registerJsFile('@web/js/favorite.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('@web/js/deleteService.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('@web/js/schedule.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.slim.js');
?>
<!--<link href='https://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<section>
    <div class="profile-banner align-items-center d-flex h-100 justify-content-center">
        <span class="profile-banner-title">Perfil de Utilizador</span>
    </div>
    <div class="profile-bg-header shadow-sm bg-white">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-3 col-sm-12 col-12 profile-div-img">
                    <img class="profile-img rounded-circle p-1 shadow bg-white" src="<?= HTML::encode($user->image); ?>">
                </div> -->
                <div class="col-md-9 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-11 col-sm-12 col-12 profile-div-infos">
                            <h1 class="profile-name m-0"><?= HTML::encode($user->name); ?></h1>
                            <h2 class="profile-username m-0">@<?= HTML::encode($user->username); ?> (<?= HTML::encode($user->plan->name); ?>)</h2>
                        </div>
                        <div class="col-md-1 col-sm-12 col-12 profile-div-report p-3">
                            <div class="dropdown dropleft shadow-sm">
                                <a id="dropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ...
                                </a>
                                <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink">
                                    <?php if($user->id != \Yii::$app->user->identity->id){ ?>
                                        <a href="<?=Url::to(['report/create']);?>" class="profile-dropdown-menu-item">Reportar</a>
                                        <br>
                                    <?php } ?>
                                    <?php if($user->id == \Yii::$app->user->identity->id){ ?>
                                        <a href="<?=Url::to(['user/update/', 'id' => \Yii::$app->user->identity->id]);?>" class="profile-dropdown-menu-item">Editar Perfil</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if($user->id != \Yii::$app->user->identity->id){ ?>
                                <p><a href="<?=Url::to(['report/create']);?>" class="profile-dropdown-menu-item">Reportar</a></p>
                            <?php } ?>
                            <?php if($user->id == \Yii::$app->user->identity->id){ ?>
                                <p><a href="<?=Url::to(['user/update/', 'id' => \Yii::$app->user->identity->id]);?>" class="profile-dropdown-menu-item">Editar Perfil</a></p>
                            <?php } ?>

                        </div>
                        <div class="col-sm-12 col-12 profile-div-info">
                            <img class="profile-first-svg align-text-top" src="<?php echo Yii::getAlias('@web') . '/assets/img/map-marked.svg' ?>"><p><?= $user->city ?>, <?= $user->country ?></p>
                            <!-- <img class="align-text-top" src="<?php echo Yii::getAlias('@web') . '/assets/img/facebook.svg' ?>"><p>Facebook</p>
                            <img class="align-text-top" src="<?php echo Yii::getAlias('@web') . '/assets/img/linkedin.svg' ?>"><p>LinkedIn</p>
                            <img class="align-text-top" src="<?php echo Yii::getAlias('@web') . '/assets/img/twitter.svg' ?>"><p>Twitter</p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!--<section class="container">
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="profile-body-section p-2 mt-3">
                <ul class="nav nav-pills ml-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#about">Sobre</a>
                    </li>
                    <?php /*if(\Yii::$app->authManager->checkAccess(\Yii::$app->user->getId(), 'jobProfile') || \Yii::$app->user->identity->id != $model->id){ */?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#services">Serviços</a>
                        </li>
                    <?php /*} */?>
                    <?php /*if($user->id == \Yii::$app->user->identity->id){ */?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#favorites">Favoritos</a>
                        </li>
                    <?php /*} */?>
                    <?php /*if(\Yii::$app->authManager->checkAccess(\Yii::$app->user->getId(), 'jobProfile')){
                        if($user->id == \Yii::$app->user->identity->id){ */?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#jobs">Trabalhos</a>
                            </li>
                        <?php /*}} */?>
                    <?php /*if($user->id == \Yii::$app->user->identity->id){ */?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#schedules">Agendamentos</a>
                        </li>
                    <?php /*} */?>
                </ul>
            </div>
        </div>
    </div>
</section>-->








<section class="container">
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="profile-body-section p-2 mt-3">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-about-tab" data-bs-toggle="pill" data-bs-target="#pills-about" type="button" role="tab" aria-controls="pills-about" aria-selected="true">Sobre</button>
                    </li>
                    <?php if(\Yii::$app->authManager->checkAccess(\Yii::$app->user->getId(), 'jobProfile') || \Yii::$app->user->identity->id != $model->id){ ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-services-tab" data-bs-toggle="pill" data-bs-target="#pills-services" type="button" role="tab" aria-controls="pills-services" aria-selected="false">Serviços</button>
                        </li>
                    <?php } ?>
                    <?php if($user->id == \Yii::$app->user->identity->id){ ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-favorites-tab" data-bs-toggle="pill" data-bs-target="#pills-favorites" type="button" role="tab" aria-controls="pills-favorites" aria-selected="false">Favoritos</button>
                        </li>
                    <?php } ?>
                    <?php if(\Yii::$app->authManager->checkAccess(\Yii::$app->user->getId(), 'jobProfile')){
                        if($user->id == \Yii::$app->user->identity->id){ ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-jobs-tab" data-bs-toggle="pill" data-bs-target="#pills-jobs" type="button" role="tab" aria-controls="pills-jobs" aria-selected="false">Trabalhos</button>
                            </li>
                        <?php }} ?>
                    <?php if($user->id == \Yii::$app->user->identity->id){ ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-schedules-tab" data-bs-toggle="pill" data-bs-target="#pills-schedules" type="button" role="tab" aria-controls="pills-schedules" aria-selected="false">Agendamentos</button>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>




<section class="container section-three">
    <?php if (\Yii::$app->session->hasFlash('success')){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= \Yii::$app->session->getFlash('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <div class="profile-body-section shadow-sm mt-2">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab" class="container tab-pane fade show active"><br>
                        <div>
                            <h4>Email:</h4>
                            <div><?= HTML::encode($user->email); ?></div>
                        </div>
                        <br>
                        <div>
                            <h4>Telemóvel:</h4>
                            <div><?= HTML::encode($user->phone); ?></div>
                        </div>
                        <br>
                        <div>
                            <h4>Género:</h4>
                            <?php if(HTML::encode($user->genre) == 'm'){ ?>
                                <div>Masculino</div>
                            <?php }else if(HTML::encode($user->genre) == 'f'){ ?>
                                <div>Feminino</div>
                            <?php }else{ ?>
                                <div>Outro</div>
                            <?php } ?>
                        </div>
                        <br>
                        <div>
                            <h4>País:</h4>
                            <div><?= HTML::encode($user->country); ?></div>
                        </div>
                        <br>
                        <div>
                            <h4>Cidade:</h4>
                            <div><?= HTML::encode($user->city); ?></div>
                        </div>
                        <br>
                        <div>
                            <h4>Biografia:</h4>
                            <div><?= HTML::encode($user->biography); ?></div>
                        </div>
                        <br>
                    </div>
                    <div id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab" class="container tab-pane fade"><br>
                        <?php if($user->id == \Yii::$app->user->identity->id){ ?>
                            <div class="mb-3">
                                <a href="<?=Url::to(['service/create']);?>" class="btns-list create">Criar Serviço</a>
                            </div>
                        <?php } ?>
                        <?php Pjax::begin(['id' => 'favorite-profile-my-service-id-wrap']); ?>
                        <?php if($services != null){ ?>
                            <?php foreach($services as $service){ ?>
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
                                            <p class="event--content-program"><a class="a-list" href="" target="" title=""><strong>Categoria: </strong><span class=""><?= Html::encode($service->category) ?></span></a>
                                                <?php if(\Yii::$app->user->identity->id != $user->id){ ?>
                                                <?php if(!\Yii::$app->user->isGuest){ ?>
                                                    <?php if($service->favorites != null){ ?>
                                                        <?php foreach($service->favorites as $favorite){ ?>
                                                            <?php if($favorite->service_id == $service->id && $favorite->user_id == \Yii::$app->user->identity->id){ ?>
                                                                <img class="home-services-favorite-heart-favorite-svg align-text-top ml-1" onclick="deleteFavoriteProfileViewMyService(<?= HTML::encode($favorite->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart-favorite.svg' ?>" alt="Heart Favorite Icon">
                                                            <?php }else{ ?>
                                                                <img class="home-services-favorite-heart-svg align-text-top ml-1" onclick="createFavoriteProfileViewMyService(<?= HTML::encode($service->id); ?>, <?= HTML::encode(\Yii::$app->user->identity->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart.svg' ?>" alt="Heart Icon">
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <img class="home-services-favorite-heart-svg align-text-top ml-1" onclick="createFavoriteProfileViewMyService(<?= HTML::encode($service->id); ?>, <?= HTML::encode(\Yii::$app->user->identity->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart.svg' ?>" alt="Heart Icon">
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                    <img class="home-services-favorite-heart-svg align-text-top" src="<?php echo Yii::getAlias('@web') . '/assets/img/edit.svg' ?>" alt="Edit Service Icon" onclick="window.open('<?=Url::to(['service/update', 'id' => $service->id]);?>', '_self')">
                                                    <img class="profile-delete-service home-services-favorite-heart-svg align-text-top" src="<?php echo Yii::getAlias('@web') . '/assets/img/delete.svg' ?>" alt="Delete Service Icon" data-toggle="modal" data-target="#deleteService" data-id="<?= $service->id ?>">
                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteService" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Serviço</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Deseja realmente eliminar o Serviço?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <?= Html::a('Apagar', ['#'], [
                                                                    'class' => 'profile-service-data btn btn-danger',
                                                                    'data-method' => 'post',
                                                                ]) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?><br><?php } else { ?>
                            <div class="alert alert-secondary" role="alert">
                                Não existem serviços para mostrar.
                            </div>
                        <?php } ?>
                        <?php Pjax::end(); ?>
                    </div>
                    <div id="pills-favorites" role="tabpanel" aria-labelledby="pills-favorites-tab" class="container tab-pane fade">
                        <?php Pjax::begin(['id' => 'favorite-profile-id-wrap']); ?>
                        <?php if($favorites != null){ ?>
                            <?php foreach($favorites as $favorite){ ?>
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
                                            <h2 class="h2-list"><a class="a-list" href="<?=Url::toRoute(['service/view/', 'id' => $favorite->service->id]);?>"><?= Html::encode($favorite->service->name) ?></a></h2>
                                            <p class="event--content-hall">
                                                <span class=""><strong>Profissional: </strong><span class="profissional"></span><a class="a-list" href="<?= Url::to(['user/view', 'id' => $favorite->service->user_id]); ?>"><?= $favorite->service->user->name ?></a></span>
                                            </p>
                                            <div class="event--content-info">
                                                <!--<div><time>20:00 - 22:00</time></div>-->
                                                <div><span class=""><strong>Localidade: </strong><span class="localidade"></span>Portugal</span></div>
                                                <div class="event--content-price"><strong>Preço: </strong>12<span class="preco"></span></div>
                                                <div class="event--content-tickets"><a class="a-list" href="#" target="" title="">Agendar</a></div>
                                            </div>
                                            <p class="event--content-ensemble"><strong>Número de Telemóvel: </strong><?= $favorite->service->user->phone ?><span class="phone"></span></p>
                                            <p class="event--content-program"><a class="a-list" href="" target="" title=""><strong>Categoria: </strong><span class=""><?= Html::encode($favorite->service->category) ?></span></a>
                                                <img class="home-services-favorite-heart-favorite-svg align-text-top ml-1" onclick="deleteFavoriteProfileView(<?= HTML::encode($favorite->id); ?>);" src="<?php echo Yii::getAlias('@web') . '/assets/img/heart-favorite.svg' ?>" alt="Heart Favorite Icon">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?><br><?php } else { ?><br>
                            <div class="alert alert-secondary" role="alert">
                                Não existem Favoritos para mostrar.
                            </div>
                        <?php } ?>
                        <?php Pjax::end(); ?>
                    </div>
                    <div id="pills-jobs" role="tabpanel" aria-labelledby="pills-jobs-tab" class="container tab-pane fade"><br>
                        <?php if($jobs != null){ ?>
                            <?php foreach($jobs as $job){ ?>
                                <section class="home-services-body-wrap row pb-3 mt-3">
                                    <section class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                        <section class="d-flex mb-2">
                                            <div class="mr-1"><strong>Nome do Serviço:</strong></div>
                                            <div><a href="<?=Url::to(['service/view/', 'id' => $job->service->id]);?>"><?= $job->service->name ?></a></div>
                                        </section>
                                        <section class="d-flex mb-2">
                                            <div class="mr-1"><strong>Cliente: </strong></div>
                                            <div><a href="<?=Url::to(['user/view/', 'id' => $job->client->id]);?>"><?= $job->client->username ?></a></div>
                                        </section>
                                        <section class="mb-3">
                                            <div class="mr-1"><strong>Nota:</strong></div>
                                            <div class="job-schedule-note text-justify overflow-hidden text-ellipsis text-break"><?= $job->note ?></div>
                                        </section>
                                    </section>
                                    <section class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="d-flex justify-content-end">
                                            <div class="mr-1"><strong>Data:</strong></div>
                                            <div><?= $job->service_date ?></div>
                                            <div class="ml-1"><?= $job->service_time ?></div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <?php Pjax::begin(['id' => 'schedule-schedule_status-wrap-prof']); ?>
                                            <?php if($job->schedule_status == '1' && $job->jobStatus->name != 'Concluído'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-success">ACEITE</span>
                                                </div>
                                            <?php } else if($job->schedule_status == '0'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-danger">CANCELADO</span>
                                                </div>
                                            <?php } else if($job->jobStatus->name == 'Concluído'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-success">CONCLUÍDO</span>
                                                </div>
                                            <?php } ?>
                                            <?php Pjax::end(); ?>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <?php Pjax::begin(['id' => 'schedule-status_job-wrap-prof']); ?>
                                            <?php if($job->jobStatus->name != 'Concluído' && $job->schedule_status != '0'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-secondary"><?= $job->jobStatus->name ?></span>
                                                </div>
                                            <?php } ?>
                                            <?php Pjax::end(); ?>
                                        </div>
                                    </section>
                                    <section class="col-xl-12 d-flex justify-content-end mb-3 mt-3">
                                        <a href="<?=Url::to(['schedule/view', 'id' => $job->id]);?>" class="btn btn-info mr-2">Detalhe</a>
                                    </section>
                                </section>
                            <?php }}else{ ?>
                            <div class="alert alert-secondary" role="alert">
                                Não Existem Trabalhos Agendados.
                            </div>
                        <?php } ?>
                    </div>
                    <div id="pills-schedules" role="tabpanel" aria-labelledby="pills-schedules-tab" class="container tab-pane fade"><br>
                        <?php if($schedules != null){ ?>
                            <?php foreach($schedules as $schedule){ ?>
                                <section class="home-services-body-wrap row pb-3 mt-3">
                                    <section class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                                        <section class="d-flex mb-2">
                                            <div class="mr-1"><strong>Nome do Serviço:</strong></div>
                                            <div><a href="<?=Url::to(['service/view/', 'id' => $schedule->service->id]);?>"><?= $schedule->service->name ?></a></div>
                                        </section>
                                        <section class="d-flex mb-2">
                                            <div class="mr-1"><strong>Professional: </strong></div>
                                            <div><a href="<?=Url::to(['user/view/', 'id' => $schedule->professional->id]);?>"><?= $schedule->professional->username ?></a></div>
                                        </section>
                                        <section class="mb-3">
                                            <div class="mr-1"><strong>Nota:</strong></div>
                                            <div class="job-schedule-note text-justify overflow-hidden text-ellipsis text-break"><?= $schedule->note ?></div>
                                        </section>
                                    </section>
                                    <section class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="d-flex justify-content-end">
                                            <div class="mr-1"><strong>Data:</strong></div>
                                            <div><?= $schedule->service_date ?></div>
                                            <div class="ml-1"><?= $schedule->service_time ?></div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <?php Pjax::begin(['id' => 'job-schedule_status-wrap']); ?>
                                            <?php if($schedule->schedule_status == '1' && $schedule->jobStatus->name != 'Concluído'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-success">ACEITE</span>
                                                </div>
                                            <?php } else if($schedule->schedule_status == '0'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-danger">CANCELADO</span>
                                                </div>
                                            <?php } else if($schedule->jobStatus->name == 'Concluído'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-success">CONCLUÍDO</span>
                                                </div>
                                            <?php } ?>
                                            <?php Pjax::end(); ?>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <?php Pjax::begin(['id' => 'job-status_job-wrap']); ?>
                                            <?php if($schedule->jobStatus->name != 'Concluído' && $schedule->schedule_status != '0'){ ?>
                                                <div>
                                                    <span class="schedule-status-badge badge badge-secondary"><?= $schedule->jobStatus->name ?></span>
                                                </div>
                                            <?php } ?>
                                            <?php Pjax::end(); ?>
                                        </div>
                                    </section>
                                    <section class="col-xl-12 d-flex justify-content-end mb-3 mt-3">
                                        <a href="<?=Url::to(['schedule/view', 'id' => $schedule->id]);?>" class="btn btn-info mr-2">Detalhe</a>
                                    </section>
                                </section>
                            <?php }}else{ ?>
                            <div class="alert alert-secondary" role="alert">
                                Não Existem Agendamentos para mostrar.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
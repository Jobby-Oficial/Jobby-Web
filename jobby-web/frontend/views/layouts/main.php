<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = "Jobby - Home";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        //'brandLabel' => '<img src="/assets/img/jobby_oficial.svg" style="display:inline"; vertical-align: top; width="100">',
        'brandLabel' => Html::img('@web/assets/img/jobby_oficial_box_white.svg'),
        //'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark fixed-top',
        ],
    ]);
    $menuItemsLeft = [
        ['label' => 'Explorar Serviços', 'url' => ['/service/index'], 'options' => ['class' => 'navbar-item-jobby']],
        ['label' => 'Favoritos', 'url' => ['/favorite/index'], 'options' => ['class' => 'navbar-item-jobby']],
        /* ['label' => 'Dropdown','items' => [
                ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
            ]
        ] */
    ];
    if (Yii::$app->user->isGuest) {
        $menuItemsRight[] = ['label' => 'Entrar', 'url' => ['/site/login'], 'options' => ['class' => 'navbar-item-jobby']];
        $menuItemsRight[] = ['label' => 'Registrar', 'url' => ['/site/signup'], 'options' => ['class' => 'navbar-item-jobby']];
    } else {
        $menuItemsRight[] = ['label' => \Yii::$app->user->identity->username, 'options' => ['class' => 'navbar-item-jobby'], 'items' => [
            ['label' => 'Perfil', 'url' => '/profile' . '/' . \Yii::$app->user->identity->id],
            ['label' => 'Planos', 'url' => '/plan'],
            ['label' => 'Logout', 'url' => '/home/logout', 'linkOptions' => ['data-method' => 'post']]
        ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav mr-auto me-auto mb-2 mb-md-0'],
        'items' => $menuItemsLeft,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItemsRight,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<!--<footer class="footer mt-auto py-3 text-muted">
    <section class="container">
        <section class="row">
            <section class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 d-flex" id="footer-info-wrap">
                <div class="footer-info-wrapper d-flex align-items-center">
                    <div class="footer-name-app">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></div>
                    <img class="footer-margin-right footer-info-dots" id="footer-info-dot-jobby" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                    <a href="<?=Url::to(['site/privacidade']);?>" class="footer-space text-decoration-none blue-effect">Privacidade</a>
                    <img class="footer-margin-right footer-info-dots" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                    <a href="<?=Url::to(['site/termo']);?>" class="footer-space text-decoration-none blue-effect">Termos</a>
                    <img class="footer-margin-right footer-info-dots" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                    <a href="<?=Url::to(['site/support']);?>" class="footer-space text-decoration-none blue-effect">Suporte</a>
                </div>
            </section>
            <section class="footer-items-wrap col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12 d-flex">
                <div class="d-flex">
                    <p class="float-end">JOBBY</p>
                </div>
            </section>
        </section>
    </section>
</footer>-->

<footer class="footer mt-auto py-3 text-muted">
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>Copyright &COPY; Jobby <?= date('Y') ?>, All Right Reserved</span>
                </div>
                <div class="col-md-6">
                    <div class="copyright-menu">
                        <ul>
                            <li>
                                <img class="footer-info-dots" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                                <a href="<?=Url::to(['site/termo']);?>">Termos de Uso</a>
                            </li>
                            <li>
                                <img class="footer-info-dots" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                                <a href="<?=Url::to(['site/privacidade']);?>">Política de Privacidade</a>
                            </li>
                            <li>
                                <img class="footer-info-dots" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                                <a href="<?=Url::to(['site/support']);?>">Suporte</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();

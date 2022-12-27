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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            ['label' => 'Perfil', 'url' => ['/profile' . '/' . \Yii::$app->user->identity->id]],
            ['label' => 'Planos', 'url' => 'plan'],
            ['label' => 'Logout', 'url' => 'logout', 'linkOptions' => ['data-method' => 'post']]
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
    <div class="container h-100">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

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
                                <a href="<?=Url::to(['/terms']);?>">Termos de Uso</a>
                            </li>
                            <li>
                                <img class="footer-info-dots" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                                <a href="<?=Url::to(['/privacy']);?>">Política de Privacidade</a>
                            </li>
                            <li>
                                <img class="footer-info-dots" src="<?php echo Yii::getAlias('@web') . '/assets/img/dot-white.svg' ?>" alt="Dot Icon">
                                <a href="<?=Url::to(['/support']);?>">Suporte</a>
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

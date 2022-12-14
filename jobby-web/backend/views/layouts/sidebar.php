<?php
    use yii\helpers\Url;
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JOBBY Backoffice</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
                <img src="<?= \Yii::$app->user->identity->image ?>" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <div class="info">
                <a href="<?php echo Url::to(['user/view', 'id' => \Yii::$app->user->identity->id]); ?>" class="d-block"><?= \Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    /* [
                        'label' => 'Starter Pages',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ], */
                    // ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Gest??o do JOBBY', 'header' => true],
                    ['label' => 'Utilizadores',  'icon' => 'file-code', 'url' => ['user/index'], 'visible' => \Yii::$app->user->can('indexUserBackoffice')],
                    ['label' => 'Servi??os',  'icon' => 'file-code', 'url' => ['service/index'], 'visible' => \Yii::$app->user->can('indexServiceBackoffice')],
                    ['label' => 'Avalia????es',  'icon' => 'file-code', 'url' => ['avaliation/index'], 'visible' => \Yii::$app->user->can('indexAvaliationBackoffice')],
                    ['label' => 'Status do Servi??os',  'icon' => 'file-code', 'url' => ['job-status/index'], 'visible' => \Yii::$app->user->can('indexJobStatusBackoffice')],
                    ['label' => 'Planos',  'icon' => 'file-code', 'url' => ['plan/index'], 'visible' => \Yii::$app->user->can('indexPlanBackoffice')],
                    ['label' => 'Den??ncias',  'icon' => 'file-code', 'url' => ['report/index'], 'visible' => \Yii::$app->user->can('indexReportBackoffice')],
                    ['label' => 'Ferramentas de Programador', 'header' => true, 'visible' => \Yii::$app->user->can('developer')],
//                    ['label' => 'Entrar', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => \Yii::$app->user->can('developer')],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => \Yii::$app->user->can('developer')],
                    /* ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    ['label' => 'Level1'],
                    [
                        'label' => 'Level1',
                        'items' => [
                            ['label' => 'Level2', 'iconStyle' => 'far'],
                            [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Level1'],
                    ['label' => 'LABELS', 'header' => true],
                    ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'], */
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
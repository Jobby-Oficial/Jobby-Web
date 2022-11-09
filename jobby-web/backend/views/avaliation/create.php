<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Avaliation $model */

$this->title = Yii::t('app', 'Criar Avaliação');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Avaliações'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'users' => $users
    ]) ?>

</div>

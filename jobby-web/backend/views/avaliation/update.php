<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Avaliation $model */

$this->title = Yii::t('app', 'Atualizar Avaliação: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Avaliações'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="avaliation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'users' => $users
    ]) ?>

</div>

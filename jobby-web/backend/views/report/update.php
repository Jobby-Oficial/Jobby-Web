<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Report $model */

$this->title = Yii::t('app', 'Atualizar Reclamação: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reclamação'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="report-update">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users
    ]) ?>

</div>

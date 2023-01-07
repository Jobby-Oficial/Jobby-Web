<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Plan $model */

$this->title = Yii::t('app', 'Criar Plano');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Planos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-create">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

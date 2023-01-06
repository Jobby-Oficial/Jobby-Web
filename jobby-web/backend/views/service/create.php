<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Service $model */

$this->title = Yii::t('app', 'Criar Serviço');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Serviços'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-create">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users
    ]) ?>

</div>

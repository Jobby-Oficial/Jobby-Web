<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\JobStatus $model */

$this->title = Yii::t('app', 'Criar Status do Serviço');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Status dos Serviços'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

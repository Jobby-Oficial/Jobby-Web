<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Report $model */

$this->title = Yii::t('app', 'Criar Reclamação');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reclamação'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/* @var common\models\ServiceSearch $searchModel */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Services');
?>
    <section class="service-index container mb-5">

    <div class="text-center mt-5">
        <h1>Serviços</h1>
    </div>

<?php Pjax::begin(['id' => 'service-id-wrap']); ?>
<?php echo $this->render('_search', ['model' => $searchModel, 'modelUser' => $searchModelUser]); ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'summary' => '',
    'emptyText' => '<br><div class="alert alert-secondary" role="alert">Não Existem Serviços para mostrar.</div>',
    'itemView' => function ($service, $key, $index, $widget) {
        return $this->render('_item', ['service' => $service]);
    },
]) ?>

<?php Pjax::end(); ?>
<?php

use common\models\Avaliation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\AvaliationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Avaliações');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliation-index">

    <?php if (\Yii::$app->session->hasFlash('success')){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= \Yii::$app->session->getFlash('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Criar Avaliação'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'avaliation',

            [
                //'label' => 'Utilizador',
                'attribute' => 'service_id',
                'value' => function($model, $index, $dataColumn) {
                    return $model->service->name;
                },

            ],
            [
                //'label' => 'Utilizador',
                'attribute' => 'user_id',
                'value' => function($model, $index, $dataColumn) {
                    return $model->user->username;
                },

            ],
            //'service_id',
            //'user_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>


<!--[
'class' => ActionColumn::className(),
'urlCreator' => function ($action, Avaliation $model, $key, $index, $column) {
return Url::toRoute([$action, 'id' => $model->id]);
}
],-->

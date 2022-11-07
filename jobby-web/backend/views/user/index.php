<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Utilizadores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

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
        <?= Html::a(Yii::t('app', 'Criar Utilizador'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            //'name',
            //'phone',
            //'genre',
            //'country',
            //'city',
            //'morada',
            //'biography:ntext',
            'status',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>


<!--[
'class' => ActionColumn::className(),
'urlCreator' => function ($action, User $model, $key, $index, $column) {
return Url::toRoute([$action, 'id' => $model->id]);
}
],-->
<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

/** @var yii\web\View $this */
/* @var common\models\ServiceSearch $searchModel */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Services');
$this->registerJsFile('https://kit.fontawesome.com/ea7160ad2a.js');
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
    'itemView' => function ($service, $key, $index, $widget) use ($modelSchedule, $modelFavorite) {
        return $this->render('_item', [
                'service' => $service,
                'modelSchedule' => $modelSchedule,
                'modelFavorite' => $modelFavorite,
        ]);
    },
]) ?>

<?php Pjax::end(); ?>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Realizar Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php $form = ActiveForm::begin(['action' => ['schedule/create']]); ?>

                        <?= $form->field($modelSchedule, 'note')->textarea() ?>

                        <?= $form->field($modelSchedule, 'price')->hiddenInput(['class' => 'service_price'])->label(false) ?>

                        <?= $form->field($modelSchedule, 'service_id')->hiddenInput(['class' => 'service_id'])->label(false) ?>

                        <?= $form->field($modelSchedule, 'service_date')->widget(DatePicker::classname(), ['name' => 'dp_5',
                            'type' => DatePicker::TYPE_INLINE,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'multidate' => false
                            ]]) ?>

                        <?= $form->field($modelSchedule, 'service_time')->widget(TimePicker::classname(), ['name' => 't1',
                            'pluginOptions' => [
                                'showSeconds' => false,
                                'showMeridian' => false,
                                'minuteStep' => 1
                            ]]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Agendar Serviço', ['class' => 'btns-list schedule w-100']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>

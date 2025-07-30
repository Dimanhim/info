<?php

use app\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use himiklab\sortablegrid\SortableGridView;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

/** @var yii\web\View $this */
/** @var app\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = $searchModel->modelName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_submenu') ?>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['class' => $model->getRowClass()];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'image_fields',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->mainImageHtml;
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function($data) {
                    return $data->typeName;
                },
                'filter' => Task::getTypeList(),
            ],
            [
                'attribute' => 'number',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->numberLink();
                }
            ],
            'name',
            [
                'attribute' => 'status_id',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->editStatusHtml();
                },
                'headerOptions' => ['style' => 'min-width: 150px;'],
                'filter' => Select2::widget([
                    'attribute' => 'status_id',
                    'model' => $searchModel,
                    'data' => Task::getStatusList(),
                    'options' => [
                        'multiple' => true
                    ],
                ]),
                //'filter' => Task::getStatusList(),
            ],
            'price',
            [
                'attribute' => 'payment_date',
                'value' => function($data) {
                    return $data->payment_date;
                },
                'filter' => [0 => 'Не оплачено', 1 => 'Оплачено'],
            ],
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function($data) {
                    return Yii::$app->formatter->asDate($data->created_at);
                },
                'headerOptions' => [
                    'class' => 'date-filter-range'
                ],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => '_created_from',
                    'attribute2' => '_created_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'dd.mm.yyyy'],
                    'options' => ['autocomplete' => 'off'],
                    'options2' => ['autocomplete' => 'off'],
                ]),
            ],
            [
                'attribute' => 'Посл. изм.',
                'value' => function($data) {
                    if($data->lastStatus) {
                        return date('d.m.Y', $data->lastStatus->created_at);
                    }
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

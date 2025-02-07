<?php

use app\models\DevInfo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DevInfoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $searchModel->modelName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dev-info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'image_fields',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->mainImageHtml;
                }
            ],
            'name',
            [
                'attribute' => 'description',
                'format' => 'raw',
                'value' => function($data) {
                    return '<div class="copy__str" data-value="'.$data->description.'">'.$data->description.'</div>';
                }
            ],
            'text',
            [
                'attribute' => 'created_at',
                'value' => function($data) {
                    return date('d.m.Y', $data->created_at);
                }
            ],
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DevInfo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

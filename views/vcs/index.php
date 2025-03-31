<?php

use app\models\Vcs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use himiklab\sortablegrid\SortableGridView;
use app\models\Project;

/** @var yii\web\View $this */
/** @var app\models\VcsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vcs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'project_id',
                'value' => function($data) {
                    if($data->project) {
                        return $data->project->name;
                    }
                },
                'filter' => Project::getList(),
            ],

            'branch',
            [
                'attribute' => 'parent_branch_id',
                'value' => function($data) {
                    if($data->parent) {
                        return $data->parent->branch;
                    }
                },
            ],
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Vcs $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

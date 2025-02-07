<?php

use app\models\Folder;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FolderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $searchModel->modelName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'mainFolder',
                'format' => 'raw',
                'value' => function($data) {
                    if($folder = $data->getMainFolder()) {
                        return Html::a($folder->name, ['folder/view', 'id' => $folder->id]);
                    }
                },
                'filter' => Folder::getMainFoldersList(),
            ],
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->parent) {
                        return Html::a($data->parent->name, ['folder/view', 'id' => $data->parent->id]);
                    }
                },
                'filter' => Folder::getMainFoldersList(),
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Folder $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Folder $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="folder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить папку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'Папка',
                'value' => function($data) {
                    if($folder = $data->mainFolder) {
                        return $folder->name;
                    }
                }
            ],
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->parent) {
                        return Html::a($data->parent->name, ['folder/view', 'id' => $data->parent->id]);
                    }
                }
            ],
        ],
    ]) ?>

</div>

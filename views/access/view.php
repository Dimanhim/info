<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Access $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="access-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить доступ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'folder_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($folder = $data->folder) {
                        return Html::a($data->fullName, ['folder/view', 'id' => $folder->id]);
                    }
                },
            ],
            [
                'attribute' => 'login',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getCopyLink('login');
                }
            ],
            [
                'attribute' => 'password',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getCopyLink('password', true);
                }
            ],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getCopyLink('url');
                }
            ],
            [
                'attribute' => 'host',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getCopyLink('host');
                }
            ],
            'comment',
        ],
    ]) ?>

</div>

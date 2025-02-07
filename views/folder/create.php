<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Folder $model */

$this->title = 'Добавление папки';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

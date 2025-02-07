<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DevInfo $model */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dev-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

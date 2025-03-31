<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Vcs $model */

$this->title = 'Добавить ветку';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vcs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
